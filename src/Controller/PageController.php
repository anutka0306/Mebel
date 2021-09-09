<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Category;
use App\Entity\Subcategory;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\CategoryRepository;
use App\Repository\SubcategoryRepository;

class PageController extends AbstractController
{
    /**
     * @var CategoryRepository
     */
    protected $categoryRepository;

    /**
     * @var SubcategoryRepository
     */
    protected $subcategoryRepository;

    public function __construct(CategoryRepository $categoryRepository, SubcategoryRepository $subcategoryRepository){
        $this->categoryRepository = $categoryRepository;
        $this->subcategoryRepository = $subcategoryRepository;
    }

    /**
     * @Route("/{token}", name="dynamic_pages",requirements={"token"= ".+\/$"})
     */
    public function index($token, Request $request){
        $token = str_replace('/','', $token);
        if($page = $this->categoryRepository->findOneBy(['alias' => $token])){
            return new Response('<p>hello from category</p>');
        }
        return new Response('<p>'.$token.'</p>');
    }
}