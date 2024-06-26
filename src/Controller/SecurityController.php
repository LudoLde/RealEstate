<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    #[Route('/login', name: 'security.login')]
    public function login(AuthenticationUtils $authenticationUtils, Request $request): Response
    {
    
        return $this->render('security/login.html.twig', [
            'error' => $authenticationUtils->getLastAuthenticationError(),
            'last_username' => $authenticationUtils->getLastUsername()
        ]);
    }

   
    #[Route('/logout', name: 'security.logout')]
    #[IsGranted('ROLE_USER')]
    public function logout(): Response
    {
        $this->addFlash('logout', 'Vous avez été déconnecté à bientôt !');
    }
}
