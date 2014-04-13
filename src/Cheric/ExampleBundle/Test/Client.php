<?php

namespace Cheric\ExampleBundle\Test;

use Symfony\Bundle\FrameworkBundle\Client as BaseClient;
use Symfony\Component\HttpFoundation\Request;

/**
 * Test client.
 */
class Client extends BaseClient
{
    /**
     * The current DBAL connection.
     */
    protected $connection;

    /**
     * Was this client already requested?
     */
    protected $requested = false;

    /**
     * @param Request $request
     *
     * @return Request
     */
    protected function doRequest($request)
    {
        if (true === $this->requested) {
            $this->kernel->shutdown();
            $this->kernel->boot();
        }

        $this->startIsolation();
        $this->requested = true;

        return $this->kernel->handle($request);
    }

    /**
     * Starts the isolation process of the client.
     */
    public function startIsolation()
    {
        if (null === $this->connection) {
            $this->connection = $this->getContainer()->get('doctrine.dbal.default_connection');
        } else {
            $this->getContainer()->set('doctrine.dbal.default_connection', $this->connection);
        }

        if (false === $this->requested) {
            $this->connection->beginTransaction();
        }
    }

    /**
     * Stops the isolation process of the client.
     */
    public function stopIsolation()
    {
        if (null !== $this->connection) {
            if ($this->connection->isTransactionActive()) {
                $this->connection->rollback();
            }

            $this->connection->close();
        }

        $this->connection = null;
    }

    /**
     * Connect a user
     *
     * @param string  $username    The username
     * @param string  $password The password
     *
     * @return Crawler
     */
    public function connect($username, $password = '11labs')
    {
        $this->followRedirects(true);

        $crawler = $this->request('GET', '/logout');
        $crawler = $this->request(
            'POST',
            '/login_check',
            array(
                '_username' => $username,
                '_password' => $password
            )
        );

        $this->followRedirects(false);

        return $this->crawler;
    }
}
