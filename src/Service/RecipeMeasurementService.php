<?php

namespace App\Service;


use App\Entity\Measurements;
use App\Repository\MeasurementsRepository;
use Doctrine\ORM\EntityManagerInterface;

class RecipeMeasurementService
{
    private $entityManager;
    private $measurementsRepository;

    public function __construct(EntityManagerInterface $entityManager, MeasurementsRepository $measurementsRepository){
        $this->entityManager = $entityManager;
        $this->measurementsRepository = $measurementsRepository;
    }

    public function addNewMeasurement($measurementName){
        if($this->isExistMeasurement($measurementName)){
            $entityMeasurement = new Measurements();
            $entityMeasurement->setName($measurementName);
            $this->entityManager->persist($entityMeasurement);
            $this->entityManager->flush();
            return true;
        }else{
            return false;
        }
    }

    public function isExistMeasurement($measurementName){

        if ($this->measurementsRepository->findBy(array('name' => $measurementName))){
            return false;
        }else{
            return true;
        }

    }

}