<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Category;
use App\Entity\Subcategory;
use App\Entity\CategorySection;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\CategoryRepository;
use App\Repository\SubcategoryRepository;
use App\Repository\CategorySectionRepository;

class PageController extends AbstractController
{
    /**
     * @var CategoryRepository
     */
    protected $categoryRepository;

    /**
     * @var CategorySectionRepository
     */
    protected $categorySectionRepository;

    /**
     * @var SubcategoryRepository
     */
    protected $subcategoryRepository;

    public function __construct(CategoryRepository $categoryRepository, CategorySectionRepository $categorySectionRepository, SubcategoryRepository $subcategoryRepository){
        $this->categoryRepository = $categoryRepository;
        $this->categorySectionRepository = $categorySectionRepository;
        $this->subcategoryRepository = $subcategoryRepository;
    }

    /**
     * @Route("/{token}", name="dynamic_pages",requirements={"token"= ".+\/$"})
     */
    public function index($token, Request $request, CategoryRepository $categoryRepository, CategorySectionRepository $categorySectionRepository, SubcategoryRepository $subcategoryRepository){
        if($page = $this->categoryRepository->findOneBy(['alias' => $token])){
            $categorySection = $categorySectionRepository->findBy(['category_id' => $page->getId()]);
            foreach ($categorySection as $key => $categorySectionItem){
                $subcategories = $this->getSubcategoriesFromSection($categorySectionItem->getId(),$subcategoryRepository);
                $categorySectionItem->sub = $subcategories;
            }



           return $this->render('pages/category.html.twig', [
               'page' => $page,
               'categorySections'=> $categorySection,
           ]);
        }
        elseif ($page = $this->subcategoryRepository->findOneBy(['alias'=>$token])){
            return new Response('<p>hello from subcategory</p>');
        }
        return new Response('<p>'.$token.'</p>');
    }

    private function getSubcategoriesFromSection($id, SubcategoryRepository $subcategoryRepository){
        return $subcategoryRepository->findBy(['category_section_id' => $id]);
    }

}