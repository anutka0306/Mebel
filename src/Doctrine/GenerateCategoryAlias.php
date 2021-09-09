<?php


namespace App\Doctrine;

use App\Service\UrlGeneratorService;
use App\Entity\Category;


class GenerateCategoryAlias
{
    /**
     * @var UrlGeneratorService
     */
    private $urlGeneratorService;

    public function __construct(UrlGeneratorService $urlGeneratorService){
        $this->urlGeneratorService = $urlGeneratorService;
    }
    public function postPersist(Category $category){
        $this->urlGeneratorService->GenerateCategoryUrl($category);
    }
}