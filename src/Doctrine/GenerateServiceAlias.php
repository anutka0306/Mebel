<?php


namespace App\Doctrine;

use App\Service\UrlGeneratorService;
use App\Entity\Service;


class GenerateServiceAlias
{
    /**
     * @var UrlGeneratorService
     */
    private $urlGeneratorService;

    public function __construct(UrlGeneratorService $urlGeneratorService){
       $this->urlGeneratorService = $urlGeneratorService;
    }

    public function postPersist(Service $service){
        $this->urlGeneratorService->GenerateServiceUrl($service);
    }

}