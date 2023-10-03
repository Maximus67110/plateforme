<?php

namespace App\Controller;

use App\Repository\LocationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(LocationRepository $locationRepository): Response
    {
        $locations = $locationRepository->findAll();
        return $this->render('home/index.html.twig', [
            'locations' => $locations,
        ]);
    }
}
