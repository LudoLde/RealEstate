<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\RealEstate;
use App\Repository\RealEstateRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class RealEstateApiController extends AbstractController
{
    #[IsGranted('ROLE_ADMIN')]
    #[Route('/api/getReal', name: 'api.getReal', methods:['GET'])]
    public function getReal(RealEstateRepository $repository): JsonResponse
    {
        $dataRealEstate = [];
        $realEstates = $repository->findAll();
        foreach ($realEstates as $realEstates) {
            $dataRealEstate[] = [
                'name'=> $realEstates->getName(),
                'cityLocation'=> $realEstates->getcityLocation(),
                'zipCode'=> $realEstates->getzipCode(),
                'description'=> $realEstates->getdescription(),
                'price'=> $realEstates->getprice(),
                
            ];
        }
        
        return new JsonResponse($dataRealEstate);
    }

    #[IsGranted('ROLE_ADMIN')]
    #[Route('/api/newReal', name: 'api.newReal', methods:['POST'])]
    public function newReal(Request $request, EntityManagerInterface $manager): JsonResponse
    {
        $realEstate = json_decode($request->getContent(), true);
        $newRealEstate = new RealEstate();
        
        if($request->files->get('imageFile')){
            $imageData = $request->files->get('imageFile');
        }

        if(isset($realEstate['name'])){
            $newRealEstate->setName($realEstate['name']);
        }
        
        $newRealEstate->setcityLocation($realEstate['cityLocation'])
                       ->setzipCode($realEstate['zipCode'])
                       ->setdescription($realEstate['description'])
                       ->setprice($realEstate['price']);
        $newRealEstate->setImageFile($imageData);

                       $manager->persist($newRealEstate);
                       $manager->flush();        
        
        return new JsonResponse('Bien créé !', 200);
    }

    #[Security("is_granted('ROLE_ADMIN') and user === app.user")]
    #[Route('/api/editReal/{id}', name: 'api.editReal', methods:['PUT'])]
    public function editReal(Request $request, EntityManagerInterface $manager, RealEstateRepository $repository,int $id): JsonResponse
    {

        $realEstate = json_decode($request->getContent(), true);
        $editRealEstate = $repository->findOneBy(['id'=> $id]);
        if($id !== $id){
            return new JsonResponse('ID incorrect');
        }
        if(isset($realEstate['name'])){
            $editRealEstate->setName($realEstate['name']);}
        if(isset($realEstate['cityLocation'])){
            $editRealEstate->setcityLocation($realEstate['cityLocation']);}
        if(isset($realEstate['zipCode'])){
            $editRealEstate->setzipCode($realEstate['zipCode']);}
        if(isset($realEstate['description'])){
            $editRealEstate->setdescription($realEstate['description']);}
        if(isset($realEstate['price'])){
            $editRealEstate->setprice($realEstate['price']);}
            
        $manager->flush();        
        
        return new JsonResponse('Bien modifié !', 200);
    }

    #[Security("is_granted('ROLE_ADMIN') and user === app.user")]
    #[Route('/api/deleteReal/{id}', name: 'api.deleteReal', methods:['DELETE'])]
    public function deleteReal(EntityManagerInterface $manager, RealEstateRepository $repository,int $id): JsonResponse
    {
        $deleteRealEstate = $repository->findOneBy(['id'=> $id]);

        $manager->remove($deleteRealEstate);     
        $manager->flush();        
        
        return new JsonResponse('Bien supprimé !', 200);
    }
}
