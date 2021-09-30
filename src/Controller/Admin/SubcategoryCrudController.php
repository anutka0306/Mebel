<?php

namespace App\Controller\Admin;

use App\Entity\Subcategory;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CodeEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;

class SubcategoryCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Subcategory::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->onlyOnIndex(),
            TextField::new('h1'),
            ImageField::new('header_img')->setUploadDir('/public/images/header_images/')->setBasePath('/images/header_images/')->setHelp('рекомендуемые размеры 2000 х 940 px'),
            TextField::new('title'),
            TextField::new('description'),
            AssociationField::new('parent'),
            AssociationField::new('category_section_id'),
            TextField::new('alias'),
            CodeEditorField::new('seo_text'),
            CodeEditorField::new('seo_text_hidden'),
            ImageField::new('seo_img')->setUploadDir('/public/images/seo-text-images/')->setBasePath('/images/seo-text-images/'),
        ];
    }

}
