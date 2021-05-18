<?php

namespace App\DataFixtures;

use App\Entity\Fish;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);

        /**
         * @var $fish Fish
         */
        $fish = new Fish();
        $fish->setName("Poisson chat")->setWater("Douce")->setMaxAge(100);
        $manager->persist($fish);

        /**
         * @var $fish Fish
         */
        $fish = new Fish();
        $fish->setName("Carpe")->setWater("Salée")->setMaxAge(110);
        $manager->persist($fish);

        /**
         * @var $fish Fish
         */
        $fish = new Fish();
        $fish->setName("Thon")->setWater("Salée")->setMaxAge(50);
        $manager->persist($fish);

        $manager->flush();
    }
}
