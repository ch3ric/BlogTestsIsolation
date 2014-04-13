<?php

namespace Cheric\ExampleBundle\Strategy;

use Doctrine\Bundle\DoctrineBundle\Registry;

use Cheric\ExampleBundle\Entity\Article;

/**
 * Useless strategy that sets the price to 42.
 * We can easily imagine another strategy that gets this price from the database.
 */
class PriceStrategy
{
    private $doctrine;

    public function __construct(Registry $doctrine)
    {
        $this->doctrine = $doctrine;
    }

    public function execute(Article $article)
    {
        $article->setPrice(42);

        $this->doctrine->getManager()->flush($article);
    }
}
