<?php

namespace Cheric\ExampleBundle\Tests\Controller;

use Cheric\ExampleBundle\Test\IsolatedWebTestCase;

class ArticleControllerTest extends IsolatedWebTestCase
{
    public function testCreate()
    {
        $this->client->connect('admin');
        $this->client->request('POST', '/secured/article', array('quantity' => 42));

        $responseContent = $this->client->getResponse()->getContent();
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
        $this->assertNotEmpty($responseContent);

        $em = $this->client->getContainer()->get('doctrine')->getManager();

        $article = $em->getRepository('ChericExampleBundle:Article')->find($responseContent);
        $this->assertEquals(42, $article->getQuantity());
        $this->assertEquals(42, $article->getPrice());
    }

    public function testUpdate()
    {
        $em = $this->client->getContainer()->get('doctrine')->getManager();

        $article = $em->getRepository('ChericExampleBundle:Article')->find(1);
        $this->assertEquals(1, $article->getQuantity());
        $this->assertEquals(1, $article->getPrice());

        $this->client->connect('admin');
        $this->client->request('PUT', '/secured/article/1', array('quantity' => 42));
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());

        $em->refresh($article);
        $this->assertEquals(42, $article->getQuantity());
        $this->assertEquals(42, $article->getPrice());
    }
}
