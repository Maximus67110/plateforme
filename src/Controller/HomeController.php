<?php

namespace App\Controller;

use App\Repository\LocationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(Request $request, LocationRepository $locationRepository): Response
    {
        $where = $request->query->get('where');
        $begin = $request->query->get('begin');
        $end = $request->query->get('end');
        $capacity = (int) $request->query->get('capacity');

        $locations = $locationRepository->search($where, $begin, $end, $capacity);
        return $this->render('home/index.html.twig', [
            'locations' => $locations,
        ]);
    }
}
