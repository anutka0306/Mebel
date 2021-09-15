<?php

namespace App\Controller\Admin;

use App\Entity\Service;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CodeEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ServiceCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Service::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->onlyOnIndex(),
            TextField::new('h1'),
            TextField::new('title'),
            TextField::new('description'),
            AssociationField::new('subcategory_id'),
            TextField::new('alias'),
            CodeEditorField::new('seo_text'),
            CodeEditorField::new('seo_text_hidden'),
            ImageField::new('seo_img')->setUploadDir('/public/images/seo-text-images/')->setBasePath('/images/seo-text-images/'),
        ];
    }

}
