<?php

namespace App\Controller\Admin;

use App\Entity\Category;
use App\Entity\Subcategory;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        return parent::index();
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Mebel Symfony');
    }

    public function configureMenuItems(): iterable
    {
        return[
        MenuItem::linkToCrud('Разделы', 'fa fa-tags', Category::class),
            MenuItem::linkToCrud('Подразделы', 'fa fa-tags', Subcategory::class),
            ];
    }
}
