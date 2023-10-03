<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/location')]
class LocationController extends AbstractController
{
    #[IsGranted("ROLE_USER")]
    #[Route('/new', name: 'app_location_new')]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $locationType = $request->query->get('locationType');
        if (!$locationType) {
            return $this->render('location/list.html.twig');
        }
        $location = new ("App\\Entity\\".$locationType)();
        $form = $this->createForm("App\\Form\\".$locationType."Type", $location);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $location->setUser($this->getUser());
            $entityManager->persist($location);
            $entityManager->flush();
            return $this->redirectToRoute('app_home');
        }

        return $this->render('location/new.html.twig', [
            'form' => $form,
            'location' => $locationType
        ]);
    }
}
