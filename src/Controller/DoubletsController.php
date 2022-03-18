<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DoubletsController extends AbstractController
{
    /**
     * @Route("/doublets", name="app_doublets")
     */
    public function index(): Response
    {
        $myArray = array(
            "foo" => "bar",
            "bar" => "foo",
        );
        return $this->json($myArray);
    }
}
