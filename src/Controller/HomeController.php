<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\CategoryRepository;
use App\Repository\SubcategoryRepository;
use App\Repository\CategorySectionRepository;
use App\Repository\ServiceRepository;

class HomeController extends AbstractController
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
     * @var CategorySectionRepository
     */
    protected $categorySectionRepository;

    /**
     * @var ServiceRepository
     */
    protected $serviceRepository;

    public function __construct(CategoryRepository $categoryRepository, SubcategoryRepository $subcategoryRepository, CategorySectionRepository $categorySectionRepository, ServiceRepository $serviceRepository){
        $this->categoryRepository = $categoryRepository;
        $this->subcategoryRepository = $subcategoryRepository;
        $this->categorySectionRepository = $categorySectionRepository;
        $this->serviceRepository = $serviceRepository;
    }

    /**
     * @Route("/", name="home")
     */
    public function index(CategoryRepository $categoryRepository, CategorySectionRepository $categorySectionRepository, SubcategoryRepository $subcategoryRepository): Response
    {
        $categories = $categoryRepository->findAll();
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'categories' => $categories,
        ]);
    }
}
