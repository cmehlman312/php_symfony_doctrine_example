<?php

namespace App\Controller;

use App\Entity\Car;
use App\Form\AssignmentType;
use App\Form\CarType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/assign', name: 'app_assign')]
class AssignController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/', name: '_index', methods: ['GET'])]
    public function index( Request $request): Response
    {
        $cars = $this->entityManager->getRepository(Car::class)->findAll();

        return $this->render('assign/index.html.twig', [
            'cars'  => $cars,
        ]);
    }

    #[Route('/show/{id}', name: '_show', requirements:['id'=>'\d+'],  methods: ['GET'])]
    public function show(int $id, Request $request): Response
    {
        $car = $this->entityManager->getRepository(Car::class)->findById($id);

        $driver = '';
        if($car->getDriverid()!==null) {
            $driver = $car->getDriverid()->getName();
        }

        return $this->render('assign/show.html.twig', [
            'car' => $car,
            'driver' => $driver,
        ]);
    }

    #[Route('/edit/{id}', name: '_edit', requirements:['id'=>'\d+'], methods: ['GET', 'POST'])]
    public function edit(int $id, Request $request): Response
    {

        $car = $this->entityManager->getRepository(Car::class)->findById($id);

        $form = $this->createForm(AssignmentType::class, $car, [
            'action'=>$this->generateUrl('app_assign_edit', ['id' => $id]),
            'method' => 'POST',
        ]);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $this->entityManager->persist($car);
            $this->entityManager->flush();

            return $this->redirectToRoute('app_assign_index');
        }

        return $this->render('assign/edit.html.twig', [
            'assign_form' => $form->createView(),
        ]);
    }

}
