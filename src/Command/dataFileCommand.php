<?php
/**
 * Performance Media Test
 *
 * @author Paweł Liwocha PAWELDESIGN <pawel.liwocha@gmail.com>
 * @copyright Copyright (c) 2020  Paweł Liwocha PAWELDESIGN (https://paweldesign.com)
 */

namespace App\Command;

use App\Entity\PerformanceData;
use App\Service\AddGoogleSheets;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Psr\Log\LoggerInterface;

class dataFileCommand extends Command
{
    /** @var LoggerInterface $logger */
    private $logger;

    /** @var AddGoogleSheets $addGoogleSheets */
    private $addGoogleSheets;

    private $container;

    /**
     * @param LoggerInterface $logger
     * @param ContainerInterface $container
     * @param AddGoogleSheets $addGoogleSheets
     */
    public function __construct(LoggerInterface $logger, ContainerInterface $container, AddGoogleSheets $addGoogleSheets)
    {
        $this->logger = $logger;
        $this->container = $container;
        $this->addGoogleSheets = $addGoogleSheets;
        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setName('perfo:data')
            ->setDescription('Build data to save in database and Google Sheets.')
            ->addArgument(
                'name',
                InputArgument::REQUIRED,
                'Add file name.'
            );
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @param bool $ignoreInterval
     * @return int
     * @throws \Exception
     */
    public function execute(InputInterface $input, OutputInterface $output)
    {
        $name = $input->getArgument('name');
        if ($name) {
            $file = file_get_contents('var/data/'.$name.'.json', true);
            if($file != NULL) {
                $time_start = microtime(true);
                $inputData = json_decode($file, true);

                $em = $this->container->get('doctrine')->getManager();
                foreach ($inputData as $key => $value) {
                    $dataTime = new \DateTime(date('Y-m-d H:i:s', strtotime($value['date'])));
                    $datas = new \DateTime('now');
                    $dataClass = new PerformanceData();
                    $dataClass->setIdFile($value['ID']);
                    $dataClass->setTitle($value['title']);
                    $dataClass->setDescription($value['description']);
                    $dataClass->setSummary($value['summary']);
                    $dataClass->setGtin($value['gtin']);
                    $dataClass->setMpn($value['mpn']);
                    $dataClass->setPrice($value['price']);
                    $dataClass->setShortcode($value['shortcode']);
                    $dataClass->setCategory($value['category']);
                    $dataClass->setSub(serialize($value['sub']));
                    $dataClass->setDate(\DateTime::createFromFormat('Y-m-d H:i:s', $dataTime->format('Y-m-d H:i:s')));
                    $dataClass->setDateTimeAdd(\DateTime::createFromFormat('Y-m-d H:i:s',$datas->format('Y-m-d H:i:s')));

                    $em->persist($dataClass);
                }
                $em->flush();
                $em->clear();

                $addToGoogle = $this->addGoogleSheets->saveDateToGoogleSheets($inputData);
                $time_end = microtime(true);
                if($addToGoogle){
                    $body = 'Sheet ID: '.$addToGoogle['spreadsheetId'].PHP_EOL.'ID: 1 '.PHP_EOL.'Date: '.date('Y-m-d H:i:s').PHP_EOL.'Time: '.(($time_end - $time_start)/60).' min'.PHP_EOL.'Memory usage: '.round(memory_get_usage() / 1024).'KB'.PHP_EOL.'Status: 1 '.PHP_EOL.'Count ROWS: '.$addToGoogle['updatedRows'];
                    $output->writeln($body);
                    return 1;
                } else {
                    $output->writeln('Error! Data not add to Google Sheets!');
                    return 0;
                }
            } else {
                $output->writeln('File is empty or not exist!');
                return 0;
            }
        } else {
            $output->writeln('Error, not set filename!');
            return 0;
        }

    }
}
