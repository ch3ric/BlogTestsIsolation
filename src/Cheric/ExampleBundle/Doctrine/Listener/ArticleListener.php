<?php

namespace Cheric\ExampleBundle\Doctrine\Listener;

use Doctrine\ORM\Event\LifecycleEventArgs;

use Cheric\ExampleBundle\Entity\Article;
use Cheric\ExampleBundle\Strategy\PriceStrategy;

class ArticleListener
{
    private $priceStrategy;

    public function __construct(PriceStrategy $priceStrategy)
    {
        $this->priceStrategy = $priceStrategy;
    }

    public function postPersist(LifecycleEventArgs $args)
    {
        $article = $args->getEntity();

        if (!$article instanceof Article) {
            return;
        }

        $this->execute($article);
    }

    private function execute(Article $article)
    {
        $this->priceStrategy->execute($article);
    }

    public function postUpdate(LifecycleEventArgs $args)
    {
        $article = $args->getEntity();

        if (!$article instanceof Article) {
            return;
        }

        $this->execute($article);
    }
}
