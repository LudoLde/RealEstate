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
    #[Route('/real_estate', name: 'realEstate.home', methods:['GET', 'POST'])]
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
}
