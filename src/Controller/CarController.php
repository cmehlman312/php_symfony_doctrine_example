<?php

namespace App\Controller;

use App\Entity\Car;
use App\Form\CarType;
use App\Repository\CarRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/car', name:'app_car')]
class CarController extends AbstractController
{
    public function __construct(private EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/', name: '_index', methods: ['GET'])]
    public function index(Request $request): Response
    {
        $cars = $this->entityManager->getRepository(Car::class)->findAll();

        return $this->render('car/index.html.twig', [
            'cars' => $cars,
        ]);
    }

    #[Route('/create', name: '_create', methods: ['GET','POST'])]
    public function create(Request $request): Response
    {
        $car = new Car();

        $form = $this->createForm(CarType::class, $car);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $newCar = $form->getData();


            $this->entityManager->persist($car);
            $this->entityManager->flush();

            return $this->redirectToRoute('app_car_index');
        }


        return $this->render('car/create.html.twig', [
            'car_form' => $form->createView(),


        ]);
    }

    #[Route('/show/{id}', name: '_show', requirements:['id'=>'\d+'], methods: ['GET'])]
    public function show(int $id, Request $request): Response
    {
        $car = $this->entityManager->getRepository(Car::class)->findById($id);

        return $this->render('car/show.html.twig', [
            'car' => $car,
        ]);
    }


    #[Route('/edit/{id}', name: '_edit', requirements:['id'=>'\d+'], methods: ['GET', 'POST'] )]
    public function edit(int $id, Request $request): Response
    {
        $car = $this->entityManager->getRepository(Car::class)->findById($id);

        $form = $this->createForm(CarType::class, $car,[
            'action'=>$this->generateUrl('app_car_edit', ['id'=>$car->getId()]),
            'method'=>'POST',
        ]);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $this->entityManager->persist($car);
            $this->entityManager->flush();

            return $this->redirectToRoute('app_car_index');
        }


        return $this->render('car/edit.html.twig', [
            'form' => $form->createView(),


        ]);
    }

    #[Route('/delete/{id}', name: '_delete', requirements:['id'=>'\d+'], methods: ['GET','DELETE'])]
    public function delete(int $id, Request $request): Response
    {
        $car = $this->entityManager->getRepository(Car::class)->findById($id);

        $this->entityManager->remove($car);
        $this->entityManager->flush();


        return $this->redirectToRoute('app_car_index');
    }

}
