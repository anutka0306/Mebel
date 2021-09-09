<?php


namespace App\Doctrine;

use App\Service\UrlGeneratorService;
use App\Entity\Subcategory;


class GenerateSubCategoryAlias
{
    /**
     * @var UrlGeneratorService
     */
    private $urlGeneratorService;

    public function __construct(UrlGeneratorService $urlGeneratorService)
    {
        $this->urlGeneratorService = $urlGeneratorService;
    }

    public function postPersist(Subcategory $subcategory){
        $this->urlGeneratorService->GenerateSubCategoryUrl($subcategory);
    }

}