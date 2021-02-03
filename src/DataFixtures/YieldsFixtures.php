<?php

namespace App\DataFixtures;

use App\Entity\Yields;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class YieldsFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $yield01 = new Yields();
        $yield01->setName("osób");
        $yield02 = new Yields();
        $yield02->setName("sztuk");

        $manager->persist($yield01);
        $manager->persist($yield02);

        $manager->flush();
    }
}
