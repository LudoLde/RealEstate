<?php

namespace App\Tests\Functional;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use App\Entity\RealEstate;
use App\Controller\RealEstateApiController;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class RealEstateApiTest extends WebTestCase
{
    public function testGetAllRealEstate(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/api/getReal');

        dump($client->getResponse()->getContent());

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertJson($client->getResponse()->getContent());
    }

    public function testNewRealEstate(): void
    {
        $client = static::createClient();

        $imagePath = '/Users/ludzy/Desktop/php92/RealEstateProject/public/images/realEstate/img-2040-6630e2a95fa89203080724.jpeg';
        $imageFile = new UploadedFile($imagePath, 'img-2040-6630e2a95fa89203080724.jpeg');
        
        $data = [
            'name' => 'Maison Basque',
            'cityLocation' => 'Bayonne',
            'zipCode' => 64,
            'description' => 'eriiucnvnb jbjej zighioz hezio he',
            'price' => 630000
        ];

        $client->request('POST', '/api/newReal', [], ['imageFile' => $imageFile], ['CONTENT_TYPE' => 'application/json'], json_encode($data));



        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function testEditRealEstate(): void
    {
        $client = static::createClient();

        $id = 1;

        $data = [
            'name' => 'Belle maison vue sur champs',
        ];

        $client->request('PUT', '/api/editReal/' . $id, [], [], ['CONTENT_TYPE' => 'application/json'], json_encode($data));



        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function testDeleteRealEstate(): void
    {
        $client = static::createClient();
        $realEstateId = 4;

        $client->request('DELETE', '/api/deleteReal/' . $realEstateId);

        
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $responseData = json_decode($client->getResponse()->getContent(), true);

        $this->assertEquals('Bien supprimé !', $responseData);
        
    }
}

