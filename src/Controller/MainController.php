<?php
/**
 * Main controller.
 */

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * Class MainController.
 *
 * @Route("/main")
 */
class MainController extends AbstractController
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
     *     name="main_index",
     *     defaults={"name":"World"},
     *     requirements={"name": "[a-zA-Z]+"},
     * )
     */
    public function index(string $name): Response
    {
        return $this->render(
            'main/index.html.twig',
            ['name' => $name]
        );
    }
}