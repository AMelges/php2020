<?php
/**
 * Index controller.
 */

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * Class IndexController.
 *
 * @Route("/index")
 */
class IndexController extends AbstractController
{
    /**
     * Index action.
     *
     * @param string $name User input
     *
     * @return \Symfony\Component\HttpFoundation\Response HTTP response
     *
     * @Route(
     *     "/{name}",
     *     methods={"GET"},
     *     name="index",
     *     defaults={"name":"World"},
     *     requirements={"name": "[a-zA-Z]+"},
     * )
     */
    public function index(string $name): Response
    {
        return $this->render(
            'index/index.html.twig',
            ['name' => $name]
        );
    }
}