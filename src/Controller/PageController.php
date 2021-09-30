<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Category;
use App\Entity\Subcategory;
use App\Entity\CategorySection;
use App\Entity\Service;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\CategoryRepository;
use App\Repository\SubcategoryRepository;
use App\Repository\CategorySectionRepository;
use App\Repository\ServiceRepository;

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

    /**
     * @var ServiceRepository
     */
    protected $serviceRepository;

    public function __construct(CategoryRepository $categoryRepository, CategorySectionRepository $categorySectionRepository, SubcategoryRepository $subcategoryRepository, ServiceRepository $serviceRepository){
        $this->categoryRepository = $categoryRepository;
        $this->categorySectionRepository = $categorySectionRepository;
        $this->subcategoryRepository = $subcategoryRepository;
        $this->serviceRepository = $serviceRepository;
    }

    /**
     * @Route("/{token}", name="dynamic_pages",requirements={"token"= ".+\/$"})
     */
    public function index($token, Request $request, CategoryRepository $categoryRepository, CategorySectionRepository $categorySectionRepository, SubcategoryRepository $subcategoryRepository, ServiceRepository $serviceRepository){

        if($page = $this->categoryRepository->findOneBy(['alias' => $token])){
            $categorySection = $categorySectionRepository->findBy(['category_id' => $page->getId()]);
            foreach ($categorySection as $key => $categorySectionItem){
                $subcategories = $this->getSubcategoriesFromSection($categorySectionItem->getId(),$subcategoryRepository);
                $categorySectionItem->sub = $subcategories;
            }

           return $this->render('pages/category.html.twig', [
               'page' => $page,
               'categorySections'=> $categorySection,
               'shortHeader' => 1,
           ]);
        }
        elseif ($page = $this->subcategoryRepository->findOneBy(['alias'=>$token])){
            $services = $serviceRepository->findBy(['subcategory_id' => $page->getId()]);
           return $this->render('pages/sub_category.html.twig',[
                'page'=>$page,
                'services' => $services,
                'shortHeader' => 1,
            ]);
        }
        return new Response('<p>'.$token.'</p>');
    }

    private function getSubcategoriesFromSection($id, SubcategoryRepository $subcategoryRepository){
        return $subcategoryRepository->findBy(['category_section_id' => $id]);
    }

}