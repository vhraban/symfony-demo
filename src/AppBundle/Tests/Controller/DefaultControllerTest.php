<?php
namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/');

        $this->assertTrue($client->getResponse()->isSuccessful());
    }

    public function testInvalidEntry()
    {
        $client = static::createClient();
        $client->followRedirects();


        $crawler = $client->request('GET', '/');

        $buttonCrawlerNode = $crawler->selectButton('Save');

        $form = $buttonCrawlerNode->form();

        $form->disableValidation();
        $form->setValues([
                            'application[name]' => null,
                            'application[sex]' => "wrongSex",
                            'application[age]' => "non-numeric",
                            'application[country]' => "Canada", // not European
        ]);

        $crawler = $client->submit($form);

        $this->assertTrue($crawler->filter('#application > div:nth-child(1) > ul > li')->text() == "This value should not be blank.");
        $this->assertTrue($crawler->filter('#application > div:nth-child(2) > ul > li')->text() == "This value is not valid.");
        $this->assertTrue($crawler->filter('#application > div:nth-child(3) > ul > li')->text() == "This value is not valid.");
        $this->assertTrue($crawler->filter('#application > div:nth-child(4) > ul > li')->text() == "This value is not valid.");
    }

    public function testValidEntry()
    {
        $client = static::createClient();
        $client->followRedirects();


        $crawler = $client->request('GET', '/');

        $buttonCrawlerNode = $crawler->selectButton('Save');

        $form = $buttonCrawlerNode->form();

        $form->disableValidation();
        $form->setValues([
            'application[name]' => "TestUser",
            'application[sex]' => "male",
            'application[age]' => "30",
            'application[country]' => "United Kingdom", // not European
        ]);

        $client->submit($form);
        $response = $client->getResponse();
        $this->assertContains('TestUser, thank you for applying to this useful government service', $response->getContent());
    }
}
