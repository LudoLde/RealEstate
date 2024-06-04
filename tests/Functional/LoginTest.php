<?php

namespace App\Tests\Functional;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class LoginTest extends WebTestCase
{
    public function testLoginIsOk(): void
    {
        $client = static::createClient();

        /** @var UrlGeneratorInterface $urlGenerator  */
        $urlGenerator = $client->getContainer()->get('router');

        $crawler = $client->request('GET', $urlGenerator->generate('security.login'));

        $submitButton = $crawler->selectButton('Se connecter');
        $form = $submitButton->form();

        $formData = [
            '_username' => 'samson.dominique@fernandes.fr',
            '_password' => 'password' 
        ];

        $client->submit($form, $formData);

        $this->assertResponseStatusCodeSame(Response::HTTP_FOUND);

        $client->followredirect();
        $this->assertRouteSame('home');

    }

    public function testLoginIsNok(): void
    {
        $client = static::createClient();

        /** @var UrlGeneratorInterface $urlGenerator  */
        $urlGenerator = $client->getContainer()->get('router');

        $crawler = $client->request('GET', $urlGenerator->generate('security.login'));

        $submitButton = $crawler->selectButton('Se connecter');
        $form = $submitButton->form();

        $formData = [
            '_username' => 'test92@test.fr',
            '_password' => 'passwor' 
        ];

        $client->submit($form, $formData);

        $this->assertResponseStatusCodeSame(Response::HTTP_FOUND);

        $client->followredirect();
        $this->assertRouteSame('security.login');

        $this->assertSelectorTextContains('div.alert-danger', 'Invalid credentials');

    }
}
