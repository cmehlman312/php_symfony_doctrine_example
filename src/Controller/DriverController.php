<?php

namespace App\Controller;

use App\Entity\Driver;
use App\Form\DriverType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/driver', name:'app_driver')]
class DriverController extends AbstractController
{
    #[Route('/', name: '_index')]
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
        $drivers = $entityManager->getRepository(Driver::class)->findAll();

        return $this->render('driver/index.html.twig', [
            'drivers' => $drivers,
        ]);
    }

    #[Route('/create', name: '_create')]
    public function create(Request $request, EntityManagerInterface $entityManager): Response
    {
        $driver = new Driver();

        $form = $this->createForm(DriverType::class, $driver);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager->persist($driver);
            $entityManager->flush();

            return $this->redirectToRoute('app_driver_index');
        }

        return $this->render('driver/create.html.twig', [
            'driver_form' => $form->createView(),


        ]);
    }

    #[Route('/show/{id}', name: '_show', requirements:['id'=>'\d+'])]
    public function show(int $id, Request $request, EntityManagerInterface $entityManager): Response
    {
        $driver = $entityManager->getRepository(Driver::class)->findById($id);

        return $this->render('driver/show.html.twig', [
            'driver' => $driver,
        ]);
    }

    #[Route('/edit/{id}', name: '_edit', requirements:['id'=>'\d+'])]
    public function edit(int $id, Request $request, EntityManagerInterface $entityManager): Response
    {
        $driver = $entityManager->getRepository(Driver::class)->findById($id);

        $form = $this->createForm(DriverType::class, $driver,[
            'action'=>$this->generateUrl('app_car_edit', ['id'=>$driver->getId()]),
            'method'=>'POST',
        ]);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager->persist($driver);
            $entityManager->flush();

            return $this->redirectToRoute('app_driver_index');
        }


        return $this->render('driver/edit.html.twig', [
            'driver_form' => $form->createView(),


        ]);
    }

}
