<?php

namespace Cheric\ExampleBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

use Cheric\ExampleBundle\Entity\Article;

class ArticleController extends Controller
{
    /**
     * @Route("/article", name="article_create")
     * @Method("POST")
     */
    public function create(Request $request)
    {
        $article = new Article();
        $article->setQuantity($request->get('quantity'));

        $em = $this->get('doctrine')->getManager();
        $em->persist($article);
        $em->flush();

        return new Response($article->getId());
    }

    /**
     * @Route("/article/{id}", name="article_update")
     * @Method("PUT")
     */
    public function update(Request $request, Article $article)
    {
        $article->setQuantity($request->get('quantity'));

        $em = $this->get('doctrine')->getManager();
        $em->flush();

        return new Response();
    }
}
