<?php
/**
 * Performance Media Test
 *
 * @author Paweł Liwocha PAWELDESIGN <pawel.liwocha@gmail.com>
 * @copyright Copyright (c) 2020  Paweł Liwocha PAWELDESIGN (https://paweldesign.com)
 */

namespace App\Service;

use Google_Client;
use Google_Service_Drive;
use Google_Service_Sheets;
use Google_Service_Sheets_ValueRange;
use Psr\Log\LoggerInterface;
use Symfony\Component\DependencyInjection\Exception\InvalidArgumentException;

class AddGoogleSheets
{
    /** @var LoggerInterface $logger */
    private $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;

    }

    /**
     * @param $inputData
     * @return string
     * @throws \Exception
     */
    public function saveDateToGoogleSheets($inputData)
    {
        $arrayData[] = ['ID','title','description','summary','gtin','mpn','price','shortcode','category','sub','date'];
        $client = new Google_Client();
        $client->setApplicationName('Performance Media test PHP Developer');
        $client->setScopes(Google_Service_Sheets::SPREADSHEETS);
        $client->setAuthConfig('var/data/pmweb-5aa3d9098ad8.json');
        $client->setAccessType('offline');

        foreach($inputData as $key => $value){
            $arrayData[] = [$value['ID'],$value['title'],$value['description'],$value['summary'],$value['gtin'],$value['mpn'],$value['price'],$value['shortcode'],$value['category'],serialize($value['sub']),$value['date']];
        }

        $spreadsheetId = "1zQ43f8eENwOwFyUrraYHM5SNKMw-rOyJnAJX66xy7p0";
        $range = "Sheet1!A1019:K";
        $params = ["valueInputOption" => "RAW"];

        $service = new Google_Service_Sheets($client);
        $valueRange= new Google_Service_Sheets_ValueRange(['values' => $arrayData]);

        $result  = $service->spreadsheets_values->update($spreadsheetId, $range, $valueRange, $params);

        if($result){
            return $result;
        } else {
            return 0;
        }
    }

}