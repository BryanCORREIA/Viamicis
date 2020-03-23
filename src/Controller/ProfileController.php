<?php

namespace App\Controller;

use App\Domain\User\UserAction;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class ProfileController extends AbstractController
{
    public function index()
    {
        $encoders = [new XmlEncoder(), new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];

        $serializer = new Serializer($normalizers, $encoders);

        $userAction = UserAction::build($this->getUser());
        $user = $serializer->serialize($userAction, 'json');
        return $this->render('profile/index.html.twig', [
            'user' => $user
        ]);
    }
}
