<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\User;
use App\Form\RegistrationType;
use App\Form\UserType;
use App\Form\UserPasswordType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;


class UserController extends AbstractController
{
    #[Route('/user/new', name: 'user.new', methods:['GET', 'POST'])]
    public function userNew(Request $request, EntityManagerInterface $manager): Response
    {
        $user = new User();

        $form = $this->createForm(RegistrationType::class, $user);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $user = $form->getData();

            $manager->persist($user);
            $manager->flush();

            return $this->redirectToRoute('security.login');
        }

        return $this->render('user/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/user/edit/{id}', name: 'user.edit', methods:['GET', 'POST'])]
    public function userEdit(Request $request, EntityManagerInterface $manager, UserRepository $repository, UserPasswordHasherInterface $hasher): Response
    {
        $user = $this->getUser();
        if(!$user){
            return $this->redirectToRoute('home');
        }

        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            if($hasher->isPasswordValid($user, $form->getData()->getPlainPassword())){
                $user = $form->getData();

                $manager->persist($user);
                $manager->flush();

                return $this->redirectToRoute('realEstate.home');

            }else{
               $this->addFlash('warning', 'le mot de passe renseigné est invalide !');
            }    
        }
        return $this->render('user/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/user/edit-password/{id}', name:('user.edit-password') ,methods:['GET', 'POST'])]
    public function userEditPassword(User $user, EntityManagerInterface $manager, Request $request, UserPasswordHasherInterface $hasher)
    {
        $user = $this->getUser();
        if(!$user){
            return $this->redirectToRoute('realEstate.home');
        }
        if($user !== $this->getUser()){
            return $this->redirectToRoute('realEstate.home');
        }

        $form = $this->createForm(UserPasswordType::class);
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()){
            if($form->getData()['plainPassword'] !== $form->getData()['newPassword'] ){
                if($hasher->isPasswordValid($user, $form->getData()['plainPassword'])){
                    $user->setPassword(
                        $hasher->hashPassword(
                           $user,
                           $form->getData()['newPassword'] 
                        ));
    
                    $manager->persist($user);
                    $manager->flush();
    
                    return $this->redirectToRoute('realEstate.home');
                }
            }else{
                $this->addFlash('warning', 'Vous ne pouvez pas utiliser le mot de passe actuel ⚠');
            }
           
        }

        return $this->render('user/edit-password.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
