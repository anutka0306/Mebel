<?php

namespace App\Controller\Admin;

use App\Entity\CategorySection;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class CategorySectionCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return CategorySection::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name'),
            AssociationField::new('category_id'),
            TextField::new('alias'),
        ];
    }

}
