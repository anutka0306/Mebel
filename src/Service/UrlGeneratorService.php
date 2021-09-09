<?php


namespace App\Service;

use App\Entity\Category;
use App\Entity\Subcategory;
use App\Repository\SubcategoryRepository;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;

class UrlGeneratorService
{
    /**
     * @var CategoryRepository
     */
    protected $categoryRepository;

    /**
     * @var SubcategoryRepository
     */
    protected $subcategoryRepository;

    /**
     * @var EntityManagerInterface
     */
    protected $em;

    public function __construct(CategoryRepository  $categoryRepository, SubcategoryRepository $subcategoryRepository, EntityManagerInterface $em){
        $this->categoryRepository = $categoryRepository;
        $this->subcategoryRepository = $subcategoryRepository;
        $this->em = $em;
    }

    public function GenerateCategoryUrl(Category $category){
       $itemPath = $category->setAlias($category->getAlias().'/');
       $this->em->persist($itemPath);
       $this->em->flush();
    }

    public function GenerateSubCategoryUrl(Subcategory $subcategory){
        $itemPath = $subcategory->setAlias($subcategory->getParent()->getAlias().$subcategory->getAlias().'/');
        $this->em->persist($itemPath);
        $this->em->flush();
    }

}