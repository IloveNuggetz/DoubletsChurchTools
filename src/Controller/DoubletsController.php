<?php

namespace App\Controller;

use App\Entity\CdbPerson;
use App\Repository\CdbPersonRepository;
use App\Repository\CdbGemeindepersonRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

use Doctrine\ORM\EntityManagerInterface;

use Psr\Log\LoggerInterface;

use Nelmio\ApiDocBundle\Annotation\Model;
use Nelmio\ApiDocBundle\Annotation\Security;
use OpenApi\Annotations as OA;

class DoubletsController extends AbstractController
{
    private $gemeindepersonRepo;
    private $personRepo;
    private $logger;
    private $em;

    public function __construct(CdbGemeindepersonRepository $gemeindepersonRepo, CdbPersonRepository $personRepo, LoggerInterface $logger, EntityManagerInterface $em)
    {
           $this->gemeindepersonRepo = $gemeindepersonRepo;
           $this->personRepo = $personRepo;
           $this->logger = $logger;
           $this->em = $em;
    }

    /**
     *
     * @Route("/api/doublets", name="doublets", methods={"GET"})
     *
     * @OA\Response(
     *     response = 200,
     *     description = "Returns all recognized person doublets",
     *     @OA\JsonContent(
     *        type="array",
     *        @OA\Items(ref=@Model(type="App\Entity\Doublet"))
     *     )
     * )
     */

    public function list(): Response
    {
        #hash map to define and save doublets
        #maybe doublets class or lists as hashbuckets
        #only re-search doublets if DB has changed

        $logger = $this->logger;
        $gemeindepersonRepo = $this->gemeindepersonRepo;
        $personRepo = $this->personRepo;

        $gemeindepersons = $gemeindepersonRepo->findAll();

        $logger->info(count($gemeindepersons));

        $map = array();


        for($i = 0; $i < count($gemeindepersons); $i++) {
            $logger->info($i);

            $personImg = $gemeindepersons[$i]->getImageurl();

            if(!is_null($personImg)) {
                $person = $gemeindepersons[$i]->getPerson();
                $name = $person->getName();
                $strasse = $person->getStrasse();


                if(!array_key_exists($personImg,$map)) {
                    $map[$personImg] = array($strasse);
                }
                else {
                    if(in_array($strasse, $map[$personImg])) {
                        $logger->info($personImg);
                        $logger->info("got it");
                     }

                    array_push($map[$personImg], $strasse);

                }

            }

        }




        $serializer = $this->container->get('serializer');
        $reports = $serializer->serialize($gemeindepersons, 'json');

        return new Response(json_encode($map));
    }




        /**
         *
         * @Route("/api/doublets/merge", name="doublets_merge", methods={"POST"})
         *
         * @OA\RequestBody(
         *     required=true,
         *     @OA\MediaType(
         *         mediaType="application/json",
         *         @OA\Schema (
         *              type="object",
         *              @OA\Property(property="firstId", description="Id of first person to merge", type="int"),
         *              @OA\Property(property="secondId", description="Id of second person to merge", type="int")
         *         )
         *     )
         * )
         * @OA\Response(
         *     response = 200,
         *     description = "Returns resulting fused person",
         *     @OA\JsonContent(ref=@Model(type="App\Entity\CdbPerson"))
         * )
         * @OA\Response(
         *     response = 404,
         *     description = "The given ids are not applicable for merging!",
         * )
         * @OA\Response(
         *     response = 400,
         *     description = "Invalid request body",
         * )
         *
         */
        public function merge(Request $request): Response
        {
        #hash map to define and save doublets
        #maybe doublets class or lists as hashbuckets
        #only re-search doublets if DB has changed

            $logger = $this->logger;
            $gemeindepersonRepo = $this->gemeindepersonRepo;
            $personRepo = $this->personRepo;
            $em = $this->em;

            $logger->info($request->getContent());

            $varPost = json_decode($request->getContent(), true);


            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new BadRequestHttpException('Invalid request body: ' . json_last_error_msg());
            }


            $logger->info($varPost['firstId']);
            $logger->info($varPost['secondId']);

            #Check if ids are valid for merge
            $validForMerge = true;


            if (!$validForMerge) {
                    throw $this->createNotFoundException('The given ids are not applicable for merging!');
            }


            $newFusionedEntity = new CdbPerson();
            $newFusionedEntity->setName('George');

            $entity = $personRepo->findOneBy(array('id' => $varPost['firstId']));
            $entity2 = $personRepo->findOneBy(array('id' => $varPost['secondId']));

            $em->transactional(function($em) {
                $em->remove($firstUser);
                $em->remove($secondUser);

                $em->persist($newFusionedEntity);
            });



            $serializer = $this->container->get('serializer');
            $reports = $serializer->serialize($newFusionedEntity, 'json');

            $response = new Response();
            $response->setContent($reports);
            $response->headers->set('Content-Type', 'application/json');



            return $response;
        }


}
