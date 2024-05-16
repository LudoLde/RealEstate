<?php

namespace App\Tests\Functional;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class RouteTest extends WebTestCase
{
    public function testPage(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h3', 'Voici les dernieres tendances:');
    }

    public function testNewPage(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/real_estate/new');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('.btn', 'Créer votre bien');
    }

    public function testEditPage(): void
    {
        $client = static::createClient();
        $id = 11;
        $crawler = $client->request('GET', '/real_estate/edit/' . $id);

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('.btn', 'Editer 🖊️');
    }
}
