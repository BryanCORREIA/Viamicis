<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\SignupType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    public function login(AuthenticationUtils $authenticationUtils, Request $request, UserPasswordEncoderInterface $encoder)
    {
        return $this->displayLoginPage($authenticationUtils, $request, $encoder);
    }

    public function loginSubmitted(AuthenticationUtils $authenticationUtils, Request $request, UserPasswordEncoderInterface $encoder) {
        return $this->displayLoginPage($authenticationUtils, $request, $encoder);
    }

    public function signupSubmitted(AuthenticationUtils $authenticationUtils, Request $request, UserPasswordEncoderInterface $encoder) {
        return $this->displayLoginPage($authenticationUtils, $request, $encoder);
    }

    public function checkUser() {
        if ($this->getUser()) {
            return $this->json('true');
        }
        return $this->json('false');
    }
    public function checkUserAdmin() {
        if ($this->getUser()) {
            if ($this->isGranted('ROLE_ADMIN')) {
                return $this->json('true');
            }
        }
        return $this->json('false');
    }

    private function displayLoginPage(AuthenticationUtils $authenticationUtils, Request $request, UserPasswordEncoderInterface $encoder) {
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();

        $em = $this->getDoctrine()->getManager();
        $user = new User();

        $form = $this->createForm(SignupType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $isExist = $this->getDoctrine()->getManager()->getRepository(User::class)->findOneBy(['email' => $user->getEmail()]);
            if (!$isExist && $form->isValid()) {
                $password = $encoder->encodePassword($user, $user->getPassword());
                $user->setPassword($password);

                $em->persist($user);
                $em->flush();

                $this->addFlash(
                    'success',
                    'Votre compte a bien été créé. Consultez vos mails afin de vérifier ce-dernier.'
                );

                return $this->redirectToRoute('security_login');
            }
            elseif ($isExist) {
                $this->addFlash(
                    'danger',
                    'Votre compte n\'a pas pu être créé. Cette adresse email est déjà utilisée.'
                );
            }
        }

        return $this->render('security/login.html.twig', [
            'last_username' => $lastUsername,
            'form' => $form->createView()
        ]);
    }
}
