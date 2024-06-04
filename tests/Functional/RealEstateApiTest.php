<?php

namespace App\Tests\Functional;

 use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
 use App\Entity\RealEstate;
 use App\Controller\RealEstateApiController;
 use Symfony\Component\HttpFoundation\File\UploadedFile;

 class RealEstateApiTest extends WebTestCase
{

    //   public function testNewRealEstate(): void
    //   {
    //       $client = static::createClient();


    //      $data = [
    //         'name' => 'Maison 16',
    //         'cityLocation' => 'Paris',
    //         'zipCode' => 75,
    //         'description' => 'zighiozgnninj gienj untin iniunie nnren',
    //         'price' => 630000,
    //         'user_id' => null
    //     ];

    //     $client->request('POST', '/api/newReal', [], [], ['CONTENT_TYPE' => 'application/json'], json_encode($data));



    //     $this->assertEquals(200, $client->getResponse()->getStatusCode());
    // }

    public function testGetAllRealEstate(): void
     {
         $client = static::createClient();
         $crawler = $client->request('GET', '/api/getReal');

         dump($client->getResponse()->getContent());

         $this->assertEquals(200, $client->getResponse()->getStatusCode());
         $this->assertJson($client->getResponse()->getContent());
     }

    // public function testEditRealEstate(): void
    // {
    //     $client = static::createClient();

    //     $id = 21;

    //     $data = [
    //         'cityLocation' => 'Bordeaux'
    //     ];

    //     $client->request('PUT', '/api/editReal/' . $id, [], [], ['CONTENT_TYPE' => 'application/json'], json_encode($data));



    //     $this->assertEquals(200, $client->getResponse()->getStatusCode());
    // }

    public function testDeleteRealEstate(): void
    {
        $client = static::createClient();
        $realEstateId = 21;

        $client->request('DELETE', '/api/deleteReal/' . $realEstateId);

        
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $responseData = json_decode($client->getResponse()->getContent(), true);

        $this->assertEquals('Bien supprimé !', $responseData);
        
    }
}

