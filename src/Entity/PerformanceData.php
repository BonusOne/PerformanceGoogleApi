<?php

namespace App\Entity;

use App\Repository\PerformanceDataRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PerformanceDataRepository::class)
 */
class PerformanceData
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $id_file;

    /**
     * @ORM\Column(type="string", length=250, nullable=true, options={"default":NULL})
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=800, nullable=true, options={"default":NULL})
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=250, nullable=true, options={"default":NULL})
     */
    private $summary;

    /**
     * @ORM\Column(type="string", length=250, nullable=true, options={"default":NULL})
     */
    private $gtin;

    /**
     * @ORM\Column(type="string", length=250, nullable=true, options={"default":NULL})
     */
    private $mpn;

    /**
     * @ORM\Column(type="string", length=250, nullable=true, options={"default":NULL})
     */
    private $price;

    /**
     * @ORM\Column(type="string", length=250, nullable=true, options={"default":NULL})
     */
    private $shortcode;

    /**
     * @ORM\Column(type="string", length=250, nullable=true, options={"default":NULL})
     */
    private $category;

    /**
     * @ORM\Column(type="string", length=800, nullable=true, options={"default":NULL})
     */
    private $sub;

    /**
     * @ORM\Column(type="datetime", nullable=true, options={"default":"CURRENT_TIMESTAMP"})
     */
    private $date;

    /**
     * @ORM\Column(type="datetime", options={"default":"CURRENT_TIMESTAMP"})
     */
    private $dateTimeAdd;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdFile(): ?int
    {
        return $this->id_file;
    }

    public function setIdFile(int $id_file): self
    {
        $this->id_file = $id_file;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getSummary(): ?string
    {
        return $this->summary;
    }

    public function setSummary(?string $summary): self
    {
        $this->summary = $summary;

        return $this;
    }

    public function getGtin(): ?string
    {
        return $this->gtin;
    }

    public function setGtin(?string $gtin): self
    {
        $this->gtin = $gtin;

        return $this;
    }

    public function getMpn(): ?string
    {
        return $this->mpn;
    }

    public function setMpn(?string $mpn): self
    {
        $this->mpn = $mpn;

        return $this;
    }

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(?string $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getShortcode(): ?string
    {
        return $this->shortcode;
    }

    public function setShortcode(?string $shortcode): self
    {
        $this->shortcode = $shortcode;

        return $this;
    }

    public function getCategory(): ?string
    {
        return $this->category;
    }

    public function setCategory(?string $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getSub(): ?string
    {
        return $this->sub;
    }

    public function setSub(?string $sub): self
    {
        $this->sub = $sub;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(?\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getDateTimeAdd(): ?\DateTimeInterface
    {
        return $this->dateTimeAdd;
    }

    public function setDateTimeAdd(?\DateTimeInterface $dateTimeAdd): self
    {
        $this->dateTimeAdd = $dateTimeAdd;

        return $this;
    }
}
