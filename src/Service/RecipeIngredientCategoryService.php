<?php

namespace App\Service;


use App\Entity\IngredientCategories;
use App\Repository\IngredientCategoriesRepository;
use Doctrine\ORM\EntityManagerInterface;

class RecipeIngredientCategoryService
{
    private $entityManager;
    private $ingredientCategoriesRepository;

    public function __construct(EntityManagerInterface $entityManager, IngredientCategoriesRepository $ingredientCategoriesRepository){
        $this->entityManager = $entityManager;
        $this->ingredientCategoriesRepository = $ingredientCategoriesRepository;
    }

    public function addNewMeasurement($ingredientCategoryName){
        if($this->isExistMeasurement($ingredientCategoryName)){
            $entityIngredientCategory = new IngredientCategories();
            $entityIngredientCategory->setName($ingredientCategoryName);
            $this->entityManager->persist($entityIngredientCategory);
            $this->entityManager->flush();
            return true;
        }else{
            return false;
        }
    }

    public function isExistMeasurement($ingredientCategoryName){

        if ($this->ingredientCategoriesRepository->findBy(array('name' => $ingredientCategoryName))){
            return false;
        }else{
            return true;
        }

    }

}