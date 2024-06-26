<?php

namespace App\Tests\Functional;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class FormCreateRealEstateTest extends WebTestCase
{
    public function testFormRealEstateIsValid(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/real_estate/new');

        file_put_contents('debug_output.html', $crawler->html());
        //Récupérer le formulaire
        $submitButton = $crawler->selectButton('real_estate_submit');
        $form = $submitButton->form();

        $formData = [
            'real_estate[name]' => 'Test',
            'real_estate[cityLocation]' => 'Paris',
            'real_estate[zipCode]' => 75,
            'real_estate[description]' => 'jiu jkhrgh irhguih ueh iuh giu',
            'real_estate[price]' => 780000
        ];

        //Soumettre le formulaire
        $client->submit($form, $formData);

        //Verifier le statut HTTP
        $this->assertResponseStatusCodeSame(Response::HTTP_FOUND);

        $client->followRedirect();
        $this->assertRouteSame('realEstate.home');
        
    }
}
