<?php

namespace App\Controller;

use App\Repository\CdbPersonRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Psr\Log\LoggerInterface;

class DoubletsController extends AbstractController
{
    /**
     * @Route("/doublets", name="app_doublets")
     */
    public function index(CdbPersonRepository $personRepo, LoggerInterface $logger): Response
    {


        $persons = $personRepo->findAll();

        $logger->info(count($persons));


        $serializer = $this->container->get('serializer');
        $reports = $serializer->serialize($persons, 'json');
        return new Response($reports);
    }


}
