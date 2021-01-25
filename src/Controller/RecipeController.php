<?php

namespace App\Controller;

use App\Entity\Measurements;
use App\Form\MeasurementFormType;
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
     * @return Response
     */
    public function addMeasurement(Request $request): Response
    {
        $form = $this->createForm(MeasurementFormType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $measurementName = $form->get('name')->getData();
            if($measurementName) {
                try {
                    $entityMeasurement = new Measurements();
                    $entityMeasurement->setName($measurementName);
                    $this->em->persist($entityMeasurement);
                    $this->em->flush();

                    $this->addFlash('success', 'Udało się dodać miarę');
                } catch (\Exception $e) {
                    $this->addFlash('error', 'Wystąpił nieoczekiwany błąd');
                }
            }
        }

        return $this->render('recipe/index.html.twig', [
            'form_measurement' => $form->createView(),
        ]);
    }


}
