<?php

namespace App\Controller;

use Nelmio\ApiDocBundle\Annotation\Model;
use Nyholm\Psr7\Factory\Psr17Factory;
use Symfony\Bridge\PsrHttpMessage\Factory\PsrHttpFactory;
use OpenApi\Annotations as OA;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Routing\Annotation\Route;

use App\Model\CdbGemeindepersonMergeRequest;

use App\Service\DoubletsService;

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
     * @Route("/api/doublets", name="doublets", methods={"GET"})
     *
     * @OA\Response(
     *     response = 200,
     *     description = "Returns all recognized person doublets",
     *     @OA\JsonContent(
     *        type="array",
     *        @OA\Items(ref=@Model(type="App\Model\DoubletDetectorResult"))
     *     )
     * )
     */
    public function list(): Response
    {
        $ds = $this->ds;

        $doublets = $ds->getExistingDoublets();

        $serializer = $this->container->get('serializer');
        $reports = $serializer->serialize($doublets, 'json');

        $response = new Response();
        $response->setContent($reports);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    /**
     * @Route("/api/doublets/merge", name="doublets_merge", methods={"POST"})
     *
     * @OA\RequestBody(
     *     required=true,
     *     @OA\JsonContent(ref=@Model(type="App\Model\CdbGemeindepersonMergeRequest"))
     * )
     * @OA\Response(
     *     response = 200,
     *     description = "Returns resulting fused person",
     *     @OA\JsonContent(ref=@Model(type="App\Entity\CdbGemeindeperson"))
     * )
     * @OA\Response(
     *     response = 404,
     *     description = "The given ids are not applicable for merging!",
     * )
     * @OA\Response(
     *     response = 400,
     *     description = "Invalid request body",
     * )
     */
    public function merge(Request $request): Response
    {
        $logger = $this->logger;
        $ds = $this->ds;

        #$logger->info($request->getContent());

        $jsonFile = file_get_contents('../openapi.json');
        $validator = (new \League\OpenAPIValidation\PSR7\ValidatorBuilder)->fromJson($jsonFile)->getServerRequestValidator();

        //http stuff to use openApi validator
        $psr17Factory = new Psr17Factory();
        $psrHttpFactory = new PsrHttpFactory($psr17Factory, $psr17Factory, $psr17Factory, $psr17Factory);
        $psrRequest = $psrHttpFactory->createRequest($request);

        $isValid = $validator->validate($psrRequest);

        $serializer = $this->container->get('serializer');
        $mergeRequest = $serializer->deserialize($request->getContent(), CdbGemeindepersonMergeRequest::class, 'json');


        $newFusionedEntity = $ds->mergePersons($mergeRequest);

        $serializer = $this->container->get('serializer');
        $reports = $serializer->serialize($newFusionedEntity, 'json');

        $response = new Response();
        $response->setContent($reports);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }
}
