<?php

namespace App\Controller;

use App\Entity\IngredientCategories;
use App\Entity\Ingredients;
use App\Form\IngredientCategoryFormType;
use App\Form\IngredientFormType;
use App\Form\MeasurementFormType;
use App\Form\TagFormType;
use App\Service\RecipeIngredientCategoryService;
use App\Service\RecipeMeasurementService;
use App\Service\RecipeTagService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RecipeController extends AbstractController
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * @Route("/recipe", name="recipe")
     */
    public function index(): Response
    {
        return $this->render('recipe/index.html.twig', [
            'controller_name' => 'RecipeController',
        ]);
    }

    /**
     * @Route("/recipe/add/measurement", name="recipe_add_measurement")
     * @param Request $request
     * @param RecipeMeasurementService $recipeMeasurementService
     * @return Response
     */
    public function addMeasurement(Request $request, RecipeMeasurementService $recipeMeasurementService): Response
    {
        $form = $this->createForm(MeasurementFormType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $measurementName = $form->get('name')->getData();
            if($measurementName) {
                try {
                    if($recipeMeasurementService->addNewMeasurement($measurementName)){
                        $this->addFlash('success', 'Udało się dodać miarę');
                    } else {
                        $this->addFlash('error', 'Dana miara już istnieje');
                    }
                } catch (\Exception $e) {
                    $this->addFlash('error', 'Wystąpił nieoczekiwany błąd');
                }
            }
            return $this->redirectToRoute('recipe');
        }

        return $this->render('recipe/add_measurement.html.twig', [
            'form_measurement' => $form->createView(),
        ]);
    }

    /**
     * @Route("/recipe/add/tag", name="recipe_add_tag")
     * @param Request $request
     * @param RecipeTagService $recipeTagService
     * @return Response
     */
    public function addTag(Request $request, RecipeTagService $recipeTagService): Response
    {
        $form = $this->createForm(TagFormType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $tagName = $form->get('name')->getData();
            if($tagName) {
                try {
                    if($recipeTagService->addNewMeasurement($tagName)){
                        $this->addFlash('success', 'Udało się dodać tag');
                    } else {
                        $this->addFlash('error', 'Dany tag już istnieje');
                    }
                } catch (\Exception $e) {
                    $this->addFlash('error', 'Wystąpił nieoczekiwany błąd');
                }
            }
            return $this->redirectToRoute('recipe');
        }

        return $this->render('recipe/add_tag.html.twig', [
            'form_tag' => $form->createView(),
        ]);
    }

    /**
     * @Route("/recipe/add/ingredient-category", name="recipe_add_ingredient_category")
     * @param Request $request
     * @param RecipeIngredientCategoryService $recipeIngredientCategoryService
     * @return Response
     */
    public function addIngredientCategory(Request $request, RecipeIngredientCategoryService $recipeIngredientCategoryService): Response
    {
        $form = $this->createForm(IngredientCategoryFormType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $tagName = $form->get('name')->getData();
            if($tagName) {
                try {
                    if($recipeIngredientCategoryService->addNewIngredientCategory($tagName)){
                        $this->addFlash('success', 'Udało się dodać kategorię składnika');
                    } else {
                        $this->addFlash('error', 'Dana kategoria składnika już istnieje');
                    }
                } catch (\Exception $e) {
                    $this->addFlash('error', 'Wystąpił nieoczekiwany błąd');
                }
            }
            return $this->redirectToRoute('recipe');
        }

        return $this->render('recipe/add_ingredient_category.html.twig', [
            'form_ingredient_category' => $form->createView(),
        ]);
    }

    /**
     * @Route("/recipe/add/ingredient", name="recipe_add_ingredient")
     * @param Request $request
     * @param RecipeIngredientCategoryService $recipeIngredientCategoryService
     * @return Response
     */
    public function addIngredient(Request $request, RecipeIngredientCategoryService $recipeIngredientCategoryService): Response
    {
        $form = $this->createForm(IngredientFormType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $ingredientName = $form->get('name')->getData();
            $ingredientCategoryName = $form->get('ingredientCategory')->getData();
            if($ingredientName) {
                try {
                    if($recipeIngredientCategoryService->addNewIngredient($ingredientName,$ingredientCategoryName )){
                        $this->addFlash('success', 'Udało się dodać składnik');
                    } else {
                        $this->addFlash('error', 'Dany składnik już istnieje');
                    }
                } catch (\Exception $e) {
                    $this->addFlash('error', 'Wystąpił nieoczekiwany błąd');
                }
            }
            return $this->redirectToRoute('recipe');
        }

        return $this->render('recipe/add_ingredient.html.twig', [
            'form_ingredient' => $form->createView(),
        ]);
    }
}
