<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CategoryRepository::class)
 * @ORM\EntityListeners({"App\Doctrine\GenerateCategoryAlias"})
 */
class Category
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=500)
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
     * @ORM\OneToMany(targetEntity=Subcategory::class, mappedBy="parent")
     */
    private $subcategory;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $alias;

    /**
     * @ORM\OneToMany(targetEntity=CategorySection::class, mappedBy="category_id", orphanRemoval=true)
     */
    private $section_id;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $seo_text_hidden;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $header_img;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $menu_img;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $menu_name;

    public function __construct()
    {
        $this->subcategory = new ArrayCollection();
        $this->section_id = new ArrayCollection();
    }

    public function __toString(){
        return (string) $this->getH1();
    }

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

    /**
     * @return Collection|Subcategory[]
     */
    public function getSubcategory(): Collection
    {
        return $this->subcategory;
    }

    public function addSubcategory(Subcategory $subcategory): self
    {
        if (!$this->subcategory->contains($subcategory)) {
            $this->subcategory[] = $subcategory;
            $subcategory->setParent($this);
        }

        return $this;
    }

    public function removeSubcategory(Subcategory $subcategory): self
    {
        if ($this->subcategory->removeElement($subcategory)) {
            // set the owning side to null (unless already changed)
            if ($subcategory->getParent() === $this) {
                $subcategory->setParent(null);
            }
        }

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

    /**
     * @return Collection|CategorySection[]
     */
    public function getSectionId(): Collection
    {
        return $this->section_id;
    }

    public function addSectionId(CategorySection $sectionId): self
    {
        if (!$this->section_id->contains($sectionId)) {
            $this->section_id[] = $sectionId;
            $sectionId->setCategoryId($this);
        }

        return $this;
    }

    public function removeSectionId(CategorySection $sectionId): self
    {
        if ($this->section_id->removeElement($sectionId)) {
            // set the owning side to null (unless already changed)
            if ($sectionId->getCategoryId() === $this) {
                $sectionId->setCategoryId(null);
            }
        }

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

    public function getMenuImg(): ?string
    {
        return $this->menu_img;
    }

    public function setMenuImg(?string $menu_img): self
    {
        $this->menu_img = $menu_img;

        return $this;
    }

    public function getMenuName(): ?string
    {
        return $this->menu_name;
    }

    public function setMenuName(?string $menu_name): self
    {
        $this->menu_name = $menu_name;

        return $this;
    }
}
