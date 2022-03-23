<?php

namespace App\Controller;

use App\Service\DoubletsService;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

use Psr\Log\LoggerInterface;

use Nelmio\ApiDocBundle\Annotation\Model;
use Nelmio\ApiDocBundle\Annotation\Security;
use OpenApi\Annotations as OA;

class DoubletsController extends AbstractController
{
    private $logger;
    private $ds;

    public function __construct(LoggerInterface $logger, DoubletsService $ds)
    {
           $this->logger = $logger;
           $this->ds = $ds;
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
        $ds = $this->ds;

        $doublets = $ds->getExistingDoublets();

        $serializer = $this->container->get('serializer');
        $reports = $serializer->serialize($doublets, 'json');

        return new Response(json_encode($doublets));
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


            $logger = $this->logger;
            $ds = $this->ds;


            $logger->info($request->getContent());

            #http stuff
            $varPost = json_decode($request->getContent(), true);

            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new BadRequestHttpException('Invalid request body: ' . json_last_error_msg());
            }

            $logger->info($varPost['firstId']);
            $logger->info($varPost['secondId']);

            $newFusionedEntity = $ds->mergePersons($varPost);



            $serializer = $this->container->get('serializer');
            $reports = $serializer->serialize($newFusionedEntity, 'json');

            $response = new Response();
            $response->setContent($reports);
            $response->headers->set('Content-Type', 'application/json');



            return $response;
        }


}
