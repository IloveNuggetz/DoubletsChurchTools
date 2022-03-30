<?php

namespace App\Controller;

use App\Model\CdbGemeindepersonMergeRequest;
use App\Service\DoubletsService;
use Nelmio\ApiDocBundle\Annotation\Model;
use Nyholm\Psr7\Factory\Psr17Factory;
use OpenApi\Annotations as OA;
use Psr\Log\LoggerInterface;
use Symfony\Bridge\PsrHttpMessage\Factory\PsrHttpFactory;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

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
     *     description = "Returns all recognized CdbGemeindeperson doublets",
     *     @OA\JsonContent(ref=@Model(type="App\Model\DoubletDetectorResult"))
     *     )
     * )
     */
    public function list(): Response
    {
        $ds = $this->ds;

        $doubletsDetectorResult = $ds->getDoublets("App\Entity\CdbGemeindeperson");

        $serializer = $this->container->get('serializer');
        $reports = $serializer->serialize($doubletsDetectorResult, 'json');

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
     *     description = "Returns resulting CdbGemeindeperson",
     *     @OA\JsonContent(ref=@Model(type="App\Entity\CdbGemeindeperson"))
     * )
     * @OA\Response(
     *     response = 404,
     *     description = "The given ids are not applicable for merging!",
     * )
     * @OA\Response(
     *     response = 500,
     *     description = "Body does not match schema!",
     * )
     */
    public function merge(Request $request): Response
    {
        $logger = $this->logger;
        $ds = $this->ds;

        //$logger->info($request->getContent());

        $this->validate($request);
        $serializer = $this->container->get('serializer');
        $mergeRequest = $serializer->deserialize($request->getContent(), CdbGemeindepersonMergeRequest::class, 'json');

        $newFusionedEntity = $ds->mergeEntities($mergeRequest, "App\Entity\CdbGemeindeperson");

        $reports = $serializer->serialize($newFusionedEntity, 'json');

        $response = new Response();
        $response->setContent($reports);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    public function validate(Request $request)
    {
        //TODO: This should get auto generated/updated on startup
        $jsonFile = file_get_contents('../openapi.json');
        $validator = (new \League\OpenAPIValidation\PSR7\ValidatorBuilder())->fromJson($jsonFile)->getServerRequestValidator();

        //http stuff to use openApi validator
        $psr17Factory = new Psr17Factory();
        $psrHttpFactory = new PsrHttpFactory($psr17Factory, $psr17Factory, $psr17Factory, $psr17Factory);
        $psrRequest = $psrHttpFactory->createRequest($request);

        $validator->validate($psrRequest);
    }
}
