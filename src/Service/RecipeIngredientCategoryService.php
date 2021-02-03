<?php

namespace App\Service;


use App\Entity\IngredientCategories;
use App\Entity\Ingredients;
use App\Repository\IngredientCategoriesRepository;
use App\Repository\IngredientsRepository;
use Doctrine\ORM\EntityManagerInterface;

class RecipeIngredientCategoryService
{
    private $entityManager;
    private $ingredientCategoriesRepository;
    private $ingredientsRepository;

    public function __construct(EntityManagerInterface $entityManager, IngredientCategoriesRepository $ingredientCategoriesRepository, IngredientsRepository $ingredientsRepository){
        $this->entityManager = $entityManager;
        $this->ingredientCategoriesRepository = $ingredientCategoriesRepository;
        $this->ingredientsRepository = $ingredientsRepository;
    }

    public function addNewIngredientCategory($ingredientCategoryName){
        if($this->isExistIngredientCategory($ingredientCategoryName)){
            $entityIngredientCategory = new IngredientCategories();
            $entityIngredientCategory->setName($ingredientCategoryName);
            $this->entityManager->persist($entityIngredientCategory);
            $this->entityManager->flush();
            return true;
        }else{
            return false;
        }
    }

    public function addNewIngredient($ingredientName,$ingredientCategoryName ){
        if($this->isExistIngredient($ingredientName)){
            $entityIngredient = new Ingredients();
            $entityIngredient->setName($ingredientName);
            $entityIngredient->setIngredientCategory($ingredientCategoryName);
            $this->entityManager->persist($entityIngredient);
            $this->entityManager->flush();
            return true;
        }else{
            return false;
        }
    }

    public function isExistIngredientCategory($ingredientCategoryName){

        if ($this->ingredientCategoriesRepository->findBy(array('name' => $ingredientCategoryName))){
            return false;
        }else{
            return true;
        }

    }

    public function isExistIngredient($ingredientName){

        if ($this->ingredientsRepository->findBy(array('name' => $ingredientName))){
            return false;
        }else{
            return true;
        }

    }

}