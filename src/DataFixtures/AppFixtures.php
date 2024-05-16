<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\RealEstate;
use App\Entity\User;
use Faker;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR');
        $users = [];
        $user = new User();{
            $user->setUsername('real_estate_admin')
                   ->setEmail('admin@test.fr')
                   ->setRoles(['ROLE_ADMIN'])
                   ->setPlainPassword('password');

        $users [] = $user;
        $manager->persist($user); 
    }

        $realEstates =[];
        $realEstate = new RealEstate();
        for($i=0;$i<10;$i++){
            $realEstate->setName('')
                   ->setCityLocation($faker->city())
                   ->setZipCode(mt_rand(01,92))
                   ->setDescription($faker->text(100))
                   ->setPrice(mt_rand(150000, 2000000))
                   ->setUser($users[mt_rand(0, count($users) -1)]);

        $realEstates [] = $realEstate;   
        $manager->persist($realEstate);              
    }
    $manager->flush();  
}
}