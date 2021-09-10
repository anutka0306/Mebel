<?php

namespace App\Entity;

use App\Repository\SubcategoryRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SubcategoryRepository::class)
 * @ORM\EntityListeners({"App\Doctrine\GenerateSubCategoryAlias"})
 */
class Subcategory
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
     * @ORM\Column(type="string", length=500, nullable=true)
     */
    private $title;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $seo_text;

    /**
     * @ORM\Column(type="string", length=300, nullable=true)
     */
    private $seo_img;

    /**
     * @ORM\ManyToOne(targetEntity=Category::class, inversedBy="subcategory")
     */
    private $parent;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $alias;

    /**
     * @ORM\ManyToOne(targetEntity=CategorySection::class, inversedBy="subcategory_id")
     * @ORM\JoinColumn(nullable=false)
     */
    private $category_section_id;

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

    public function getSeoText(): ?string
    {
        return $this->seo_text;
    }

    public function setSeoText(?string $seo_text): self
    {
        $this->seo_text = $seo_text;

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

    public function getParent(): ?Category
    {
        return $this->parent;
    }

    public function setParent(?Category $parent): self
    {
        $this->parent = $parent;

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

    public function getCategorySectionId(): ?CategorySection
    {
        return $this->category_section_id;
    }

    public function setCategorySectionId(?CategorySection $category_section_id): self
    {
        $this->category_section_id = $category_section_id;

        return $this;
    }
}
