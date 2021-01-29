<?php

namespace App\Service;

use App\Entity\Tags;
use App\Repository\TagsRepository;
use Doctrine\ORM\EntityManagerInterface;

class RecipeTagService
{
    private $entityManager;
    private $tagsRepository;

    public function __construct(EntityManagerInterface $entityManager, TagsRepository $tagsRepository){
        $this->entityManager = $entityManager;
        $this->tagsRepository = $tagsRepository;
    }

    public function addNewMeasurement($tagName){
        if($this->isExistMeasurement($tagName)){
            $entityTag = new Tags();
            $entityTag->setName($tagName);
            $this->entityManager->persist($entityTag);
            $this->entityManager->flush();
            return true;
        }else{
            return false;
        }
    }

    public function isExistMeasurement($tagName){

        if ($this->tagsRepository->findBy(array('name' => $tagName))){
            return false;
        }else{
            return true;
        }

    }

}