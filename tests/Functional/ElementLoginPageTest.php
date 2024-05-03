<?php

namespace App\Tests\Functional;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ElementHomePageTest extends WebTestCase
{
    public function testElementLoginPage(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/login');

        $this->assertResponseIsSuccessful();

        // Récupérer le contenu de la page
        $content = $client->getResponse()->getContent();
        
        // Vérifier éléments
        $this->assertStringContainsString('Email adress', $content);
        $this->assertStringContainsString('Password', $content);
        
    }
}
