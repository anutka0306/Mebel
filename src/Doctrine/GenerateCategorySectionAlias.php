<?php


namespace App\Doctrine;

use App\Service\UrlGeneratorService;
use App\Entity\CategorySection;


class GenerateCategorySectionAlias
{
    /**
     * @var UrlGeneratorService
     */
    private $urlGeneratorService;

    public function __construct(UrlGeneratorService $urlGeneratorService)
    {
        $this->urlGeneratorService = $urlGeneratorService;
    }

    public function postPersist(CategorySection $categorySection){
        $this->urlGeneratorService->GenerateCategorySectionUrl($categorySection);
    }

}