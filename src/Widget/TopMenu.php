<?php


namespace App\Widget;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\CategoryRepository;
use App\Repository\CategorySectionRepository;
use App\Repository\SubcategoryRepository;


class TopMenu extends AbstractController
{

    public function show(CategoryRepository $categoryRepository, CategorySectionRepository $categorySectionRepository, SubcategoryRepository $subcategoryRepository){
        $topMenu = array();
        $categories = $categoryRepository->findAll();
        foreach ($categories as $category){
            $topMenu[$category->getH1()] = array();
            $topMenu[$category->getH1()]['url'] = $category->getAlias();
            $topMenu[$category->getH1()]['img'] = $category->getMenuImg();
            $topMenu[$category->getH1()]['menuName'] = $category->getMenuName();

            $sections = $categorySectionRepository->findBy(['category_id' => $category->getId()]);
            $topMenu[$category->getH1()]['sections'] = array();
            foreach ($sections as $section){
                $topMenu[$category->getH1()]['sections'][$section->getName()] = array();
                $topMenu[$category->getH1()]['sections'][$section->getName()]['menuName'] = $section->getMenuName();
                $topMenu[$category->getH1()]['sections'][$section->getName()]['subcategory'] = array();
                $subcategories = $subcategoryRepository->findBy(['category_section_id'=>$section->getId()]);
                foreach ($subcategories as $subcategory){
                    $topMenu[$category->getH1()]['sections'][$section->getName()]['subcategory'][$subcategory->getH1()] = array();
                    $topMenu[$category->getH1()]['sections'][$section->getName()]['subcategory'][$subcategory->getH1()]['url'] =  $subcategory->getAlias();
                    $topMenu[$category->getH1()]['sections'][$section->getName()]['subcategory'][$subcategory->getH1()]['menuName'] = $subcategory->getMenuName();
                }
            }
        }

        return $this->render('elements/header.html.twig', compact('topMenu'));
    }
}