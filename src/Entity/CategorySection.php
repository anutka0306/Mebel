<?php

namespace App\Entity;

use App\Repository\CategorySectionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CategorySectionRepository::class)
 * @ORM\EntityListeners({"App\Doctrine\GenerateCategorySectionAlias"})
 */
class CategorySection
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
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity=Category::class, inversedBy="section_id")
     * @ORM\JoinColumn(nullable=false)
     */
    private $category_id;

    /**
     * @ORM\OneToMany(targetEntity=Subcategory::class, mappedBy="category_section_id", orphanRemoval=true)
     */
    private $subcategory_id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $alias;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $menu_name;

    public function __construct()
    {
        $this->subcategory_id = new ArrayCollection();
    }

    public function __toString(){
        return (string) $this->getName();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getCategoryId(): ?Category
    {
        return $this->category_id;
    }

    public function setCategoryId(?Category $category_id): self
    {
        $this->category_id = $category_id;

        return $this;
    }

    /**
     * @return Collection|Subcategory[]
     */
    public function getSubcategoryId(): Collection
    {
        return $this->subcategory_id;
    }

    public function addSubcategoryId(Subcategory $subcategoryId): self
    {
        if (!$this->subcategory_id->contains($subcategoryId)) {
            $this->subcategory_id[] = $subcategoryId;
            $subcategoryId->setCategorySectionId($this);
        }

        return $this;
    }

    public function removeSubcategoryId(Subcategory $subcategoryId): self
    {
        if ($this->subcategory_id->removeElement($subcategoryId)) {
            // set the owning side to null (unless already changed)
            if ($subcategoryId->getCategorySectionId() === $this) {
                $subcategoryId->setCategorySectionId(null);
            }
        }

        return $this;
    }

    public function getAlias(): ?string
    {
        return $this->alias;
    }

    public function setAlias(?string $alias): self
    {
        $this->alias = $alias;

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
