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
        $this->assertSelectorTextContains('h3', 'Most recents real estates:');
    }

    public function testNewPage(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/real_estate/new');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('.btn', 'Submit me');
    }

    public function testEditPage(): void
    {
        $client = static::createClient();
        $id = 6;
        $crawler = $client->request('GET', '/real_estate/edit/' . $id);

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('.btn', 'Edit !');
    }
}
