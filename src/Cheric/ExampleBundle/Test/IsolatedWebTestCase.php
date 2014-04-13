<?php

namespace Cheric\ExampleBundle\Test;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase as BaseWebTestCase;

class IsolatedWebTestCase extends BaseWebTestCase
{
    protected $client;

    public function setUp()
    {
        parent::setUp();

        $this->client = self::createClient();

        $this->client->startIsolation();
    }

    public function tearDown()
    {
        if (null !== $this->client) {
            $this->client->stopIsolation();
        }

        parent::tearDown();
    }
}
