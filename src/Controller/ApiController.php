<?php

namespace App\Controller;

use App\Domain\Api\Trip\AddTripAction;
use App\Domain\Api\Trip\AddTripHandler;
use App\Domain\Api\Trip\GetAllTripAction;
use App\Domain\Api\Trip\GetAllTripHandler;
use App\Domain\Api\Trip\GetTripHandler;
use App\Entity\Trip;
use App\Entity\Wish;
use Doctrine\DBAL\Exception\DatabaseObjectExistsException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Translation\Exception\NotFoundResourceException;

class ApiController extends AbstractController
{
    /**
     * @var AddTripHandler
     */
    private $addTripHandler;

    /**
     * @var GetAllTripHandler
     */
    private $getAllTripHandler;

    /**
     * @var GetTripHandler
     */
    private $getTripHandler;

    public function __construct(
        AddTripHandler $addTripHandler,
        GetAllTripHandler $getAllTripHandler,
        GetTripHandler $getTripHandler
    ) {
        $this->addTripHandler       = $addTripHandler;
        $this->getAllTripHandler    = $getAllTripHandler;
        $this->getTripHandler       = $getTripHandler;
    }

    public function index()
    {
        return $this->render('api/index.html.twig', [
            'controller_name' => 'ApiController',
        ]);
    }

    public function addTrip(Request $request)
    {
        dump($request->isXmlHttpRequest());
        if (!$request->isXmlHttpRequest()) {
            return $this->redirectToRoute('index');
        }

        $encoders = [new XmlEncoder(), new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];

        $_trip = $request->getContent();
        $serializer = new Serializer($normalizers, $encoders);

        $action = $serializer->denormalize(json_decode($_trip), AddTripAction::class, 'json');
        $action->creator = $this->getUser();

        $this->addTripHandler->handle($action);

        return $this->json('done');
    }

    public function getAllTrip(Request $request)
    {
        /*
        if (!$request->isXmlHttpRequest()) {
            return $this->redirectToRoute('index');
        }
        */

        $action = GetAllTripAction::build($this->getUser());
        $listTrip = $this->getAllTripHandler->handle($action);

        $encoders = [new XmlEncoder(), new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];

        $serializer = new Serializer($normalizers, $encoders);
        $allTrips = $serializer->serialize($listTrip, 'json');

        return $this->json($allTrips);
    }

    public function getTrip($id) {
        $trip = $this->getTripHandler->handle($id, $this->getUser());

        $encoders = [new XmlEncoder(), new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];

        $serializer = new Serializer($normalizers, $encoders);
        $trip = $serializer->serialize($trip, 'json');

        return $this->json($trip);
    }

    public function wishTrip(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $trip = $em->getRepository(Trip::class)->findOneBy(['id' => $request->request->get('trip')]);

        if (null === $trip) {
            throw new NotFoundResourceException();
        }

        if ($em->getRepository(Wish::class)->findOneBy(['user' => $this->getUser(), 'trip' => $trip])) {
            throw new Exception();
        }

        $wish = new Wish();

        $wish->setUser($this->getUser());
        $wish->setTrip($trip);

        $em->persist($wish);
        $em->flush();

        return $this->json('OK');
    }
}
