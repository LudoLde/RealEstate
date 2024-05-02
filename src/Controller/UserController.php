<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
class UserController extends AbstractController
{
    #[Route('/real_estate/user/new', name: 'user.new', methods:['GET', 'POST'])]
    public function userNew(Request $request, EntityManagerInterface $manager): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $user = $form->getData();

            $manager->persist($user);
            $manager->flush();

            return $this->redirectToRoute('realEstate.home');
        }

        return $this->render('user/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/real_estate/edit/{id}', name: 'realEstate.edit', methods:['GET', 'POST'])]
    public function edit(Request $request, EntityManagerInterface $manager, RealEstateRepository $repository, int $id): Response
    {
        $realEstate = $repository->findOneBy(["id" => $id]);

        if($id !== $id){
            return $this->redirectToRoute('realEstate.home');
        }
        $form = $this->createForm(RealEstateType::class, $realEstate);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $realEstate = $form->getData();

            $manager->persist($realEstate);
            $manager->flush();

            return $this->redirectToRoute('realEstate.home');
            
        }
        return $this->render('realEstate/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}