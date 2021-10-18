<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\CategoryRepository;
use App\Repository\SubcategoryRepository;
use App\ParserData\Data;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Subcategory;

class ParserController extends AbstractController
{
    /**
     * @var Data;
     */
    private $data;
    /**
     * @var CategoryRepository
     */
    private $categoryRepository;

    /**
     * @var SubcategoryRepository
     */
    private $subcategoryRepository;

    /**
     * @var EntityManagerInterface
     */
    protected $em;

    public  function __construct(CategoryRepository $categoryRepository, SubcategoryRepository  $subcategoryRepository, Data $data, EntityManagerInterface $em)
    {
        $this->categoryRepository = $categoryRepository;
        $this->subcategoryRepository = $subcategoryRepository;
        $this->data = $data;
        $this->em = $em;
    }

    /**
     * @Route("/parser", name="parser")
     */
    public function index(Data $data, SubcategoryRepository $subcategoryRepository): Response
    {
        $my_array = array();
        foreach ($data->getData() as $text){
            $title = trim($text['title']);
            $element = $subcategoryRepository->findOneBy(['h1'=>$title]);
            if($element){
                $itemText = $element->setSeoText($text['data']);
                if(isset($text['data_hidden'])){
                    $itemText = $element->setSeoTextHidden($text['data_hidden']);
                }
                $this->em->persist($itemText);
                $this->em->flush();
                var_dump('yes');
            }else{
                var_dump($text);
            }
            $my_array[] = $element;
        }





        return $this->render('parser/index.html.twig', [
            'controller_name' => $data->getData(),
            'my_array' => $my_array,
        ]);
    }
}
