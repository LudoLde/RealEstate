<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\IsFavourite;
use App\Entity\RealEstate;
use App\Repository\IsFavouriteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class FavController extends AbstractController
{
    #[Route('/fav/new/{id}', name: 'fav.new', methods:['GET', 'POST'])]
    public function newFav(Request $request, int $id, EntityManagerInterface $manager): Response
    {
        $user = $this->getUser();

        if (!$user) {
            return $this->redirectToRoute('security.login');
        }

        // Récupérer le bien immobilier à ajouter aux favoris
        $realEstate = $manager->getRepository(RealEstate::class)->find($id);

        $favoris = new IsFavourite();
            $favoris->setUserId($user);
            $favoris->setRealEstateId($realEstate);

            $manager->persist($favoris);
            $manager->flush();


            return $this->redirectToRoute('fav.show');
    }

    #[Route('/fav', name: 'fav.show', methods:['GET'])]
    public function showFav(IsFavouriteRepository $repository): Response
    {
        
        if(!$this->isGranted('ROLE_USER')){
            throw new AccessDeniedException('Access denied');
        }
        
        $favs = $repository->findAll();
        return $this->render('fav/index.html.twig', [
            'favs' => $favs
        ]);
    }

    #[Route('/fav/delete/{id}', name: 'fav.delete', methods:['GET', 'POST'])]
    public function deleteFav(IsFavouriteRepository $repository, EntityManagerInterface $manager, int $id): Response
    {
        $user = $this->getUser();
        if(!$user){
            return $this->redirectToRoute('fav.show');
        }

        $deletefav = $manager->getRepository(IsFavourite::class)->findOneBy(['realEstateId'=> $id, 'userId'=>$user]);

        $manager->remove($deletefav);     
        $manager->flush(); 

        return $this->redirectToRoute('fav.show');
    }
}
