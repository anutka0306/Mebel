<?php

namespace App\Controller\Admin;

use App\Entity\Category;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\CodeEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class CategoryCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Category::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->onlyOnIndex(),
            TextField::new('h1'),
            TextField::new('menu_name', 'Название в меню')->setHelp('Оставить пустым, если совпадает с H1'),
            ImageField::new('menu_img', 'Картинка в выпадающем меню')->setUploadDir('/public/images/menu_images/')->setBasePath('/images/menu_images/')->setHelp('рекомендуемые размеры 260 x 247 px'),
            ImageField::new('header_img')->setUploadDir('/public/images/header_images/')->setBasePath('/images/header_images/')->setHelp('рекомендуемые размеры 2000 х 940 px'),
            TextField::new('title'),
            TextField::new('description'),
            CodeEditorField::new('seo_text'),
            CodeEditorField::new('seo_text_hidden'),
            ImageField::new('seo_img')->setUploadDir('/public/images/seo-text-images/')->setBasePath('/images/seo-text-images/')
        ];
    }

}
