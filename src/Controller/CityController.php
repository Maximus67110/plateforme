<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CityController extends AbstractController
{
    #[Route('/city', name: 'app_city')]
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
        $city = $request->query->get('name');
        $con = $entityManager->getConnection();
        if (!$city) {
            $sql = 'SELECT ville_departement, ville_nom_simple, ville_nom_reel, ville_latitude_deg, ville_longitude_deg FROM fixture_city';
        } else {
            $sql = 'SELECT ville_departement, ville_nom_simple, ville_nom_reel, ville_latitude_deg, ville_longitude_deg FROM fixture_city where ville_nom_simple LIKE :city';
        }
        $resultSet = $con->executeQuery($sql, ['city' => "%$city%"]);
        $results = $resultSet->fetchAllAssociative();

        return $this->json($results);
    }
}
