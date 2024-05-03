<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\RealEstate;
use App\Repository\RealEstateRepository;
use App\Form\RealEstateType;
use Doctrine\ORM\EntityManagerInterface;

class RealEstateController extends AbstractController
{
    #[Route('/', name: 'realEstate.home', methods:['GET', 'POST'])]
    public function index(RealEstateRepository $repository): Response
    {
        $realEstates = $repository->findAll();

        return $this->render('realEstate/index.html.twig', [
            'realEstates' => $realEstates,
        ]);
    }

    #[Route('/real_estate/new', name: 'realEstate.new', methods:['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $manager): Response
    {
        $realEstate = new RealEstate();
        $form = $this->createForm(RealEstateType::class, $realEstate);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $realEstate = $form->getData();

            $manager->persist($realEstate);
            $manager->flush();

            return $this->redirectToRoute('realEstate.home');
        }

        return $this->render('realEstate/new.html.twig', [
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

    #[Route('/real_estate/delete/{id}', name: 'realEstate.delete', methods:['GET', 'POST'])]
    public function delete(EntityManagerInterface $manager, RealEstateRepository $repository, int $id): Response
    {
        $realEstate = $repository->findOneBy(["id" => $id]);

        if($id !== $id){
            return $this->redirectToRoute('realEstate.home');
        }

            $manager->remove($realEstate);
            $manager->flush();

            return $this->redirectToRoute('realEstate.home');
            
    }
}
