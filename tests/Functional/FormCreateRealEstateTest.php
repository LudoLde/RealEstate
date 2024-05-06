<?php

namespace App\Tests\Functional;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class FormCreateRealEstateTest extends WebTestCase
{
    public function testFormRealEstate(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/real_estate/new');

        //Récupérer le formulaire
        $submitButton = $crawler->selectButton('Submit me');
        $form = $submitButton->form();

        $formData = [
            'real_estate[name]' => 'Bel appartement',
            'real_estate[cityLocation]' => 'Paris',
            'real_estate[zipCode]' => 75,
            'real_estate[description]' => 'jiu jkhrgh irhguih ueh iuh giu',
            'real_estate[price]' => 780000,
        ];

        //Soumettre le formulaire
        $client->submit($form, $formData);

        //Verifier le statut HTTP
        $this->assertResponseStatusCodeSame(Response::HTTP_FOUND);
        
    }
}
