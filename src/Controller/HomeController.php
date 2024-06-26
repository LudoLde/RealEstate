<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\RealEstateRepository;
use App\Entity\RealEstate;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(RealEstateRepository $repository): Response
    {
        $realEstates = $repository->findAll();

        return $this->render('home/index.html.twig', [
            'realEstates' => $realEstates,
        ]);
    }
}
