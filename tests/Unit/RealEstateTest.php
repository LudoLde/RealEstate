<?php

namespace App\tests\Unit;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use App\Entity\RealEstate;

class RealEstateTest extends KernelTestCase
{
    public function testEntityIsValid(): void
    {
        $kernel = self::bootKernel();
        $container = static::GetContainer();

        $RealEstate = new RealEstate();
        $RealEstate->setName('Test')
        ->setCityLocation('Paris')
        ->setZipCode(92)
        ->setDescription('description test ')
        ->setPrice(400000);

        
        $errors = $container->get('validator')->validate($RealEstate);

        $this->assertCount(0, $errors);
    }
}
