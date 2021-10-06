<?php

namespace App\Entity;

use App\Repository\ServiceRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ServiceRepository::class)
 * @ORM\EntityListeners({"App\Doctrine\GenerateServiceAlias"})
 */
class Service
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $h1;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $title;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity=Subcategory::class, inversedBy="service")
     */
    private $subcategory_id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $seo_img;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $alias;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $seo_text;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $seo_text_hidden;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $header_img;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getH1(): ?string
    {
        return $this->h1;
    }

    public function setH1(string $h1): self
    {
        $this->h1 = $h1;

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

    public function getSubcategoryId(): ?Subcategory
    {
        return $this->subcategory_id;
    }

    public function setSubcategoryId(?Subcategory $subcategory_id): self
    {
        $this->subcategory_id = $subcategory_id;

        return $this;
    }

    public function getSeoImg(): ?string
    {
        return $this->seo_img;
    }

    public function setSeoImg(?string $seo_img): self
    {
        $this->seo_img = $seo_img;

        return $this;
    }

    public function getAlias(): ?string
    {
        return $this->alias;
    }

    public function setAlias(string $alias): self
    {
        $this->alias = $alias;

        return $this;
    }

    public function getSeoText(): ?string
    {
        return $this->seo_text;
    }

    public function setSeoText(?string $seo_text): self
    {
        $this->seo_text = $seo_text;

        return $this;
    }

    public function getSeoTextHidden(): ?string
    {
        return $this->seo_text_hidden;
    }

    public function setSeoTextHidden(?string $seo_text_hidden): self
    {
        $this->seo_text_hidden = $seo_text_hidden;

        return $this;
    }

    public function getHeaderImg(): ?string
    {
        return $this->header_img;
    }

    public function setHeaderImg(?string $header_img): self
    {
        $this->header_img = $header_img;

        return $this;
    }
}
