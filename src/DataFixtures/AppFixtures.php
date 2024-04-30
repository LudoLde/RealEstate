<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\RealEstate;
use Faker;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR');
        $realEstate = new RealEstate();
        for($i=0;$i<10;$i++){
            $realEstate->setName('')
                   ->setCityLocation($faker->city())
                   ->setZipCode(mt_rand(01,92))
                   ->setDescription($faker->text(100))
                   ->setPrice(mt_rand(150000, 2000000));
        $manager->persist($realEstate);            
        $manager->flush();
        }
        
    }
}
