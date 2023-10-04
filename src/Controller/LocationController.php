<?php

namespace App\Controller;

use App\Entity\Location;
use App\Repository\LocationRepository;
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
    #[Route('/new', name: 'app_location_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $locationType = $request->query->get('locationType');
        if (!$locationType) {
            return $this->render('location/new-list.html.twig');
        }
        if (class_exists('App\\Entity\\' . $locationType) && get_parent_class('App\\Entity\\'.$locationType) === "App\\Entity\\Location") {
            $location = new ("App\\Entity\\".$locationType)();
            $form = $this->createForm("App\\Form\\".$locationType."Type", $location);
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                $location->setUser($this->getUser());
                $entityManager->persist($location);
                $entityManager->flush();
                return $this->redirectToRoute('app_home');
            }
        } else {
            return $this->render('location/new-list.html.twig');
        }

        return $this->render('location/new.html.twig', [
            'form' => $form,
            'location' => $locationType,
        ]);
    }

    #[IsGranted("ROLE_USER")]
    #[Route('/edit/{id}', name: 'app_location_edit', requirements: ['id' => '\d+'], methods: ['GET', 'POST'])]
    public function edit(Request $request, Location $location, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm("App\\Form\\".$location->getClassName()."Type", $location);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($location);
            $entityManager->flush();
            return $this->redirectToRoute('app_location_list');
        }
        return $this->render('location/edit.html.twig', [
            'form' => $form,
        ]);
    }

    #[IsGranted("ROLE_USER")]
    #[Route('/delete/{id}', name: 'app_location_delete', requirements: ['id' => '\d+'], methods: ['GET'])]
    public function delete(Location $post, EntityManagerInterface $entityManager): Response
    {
        $entityManager->remove($post);
        $entityManager->flush();
        return $this->redirectToRoute('app_location_list');
    }

    #[IsGranted("ROLE_USER")]
    #[Route('/', name: 'app_location_list', methods: ['GET'])]
    public function list(LocationRepository $locationRepository): Response
    {
        $locations = $locationRepository->findAll();

        return $this->render('location/list.html.twig', [
            'locations' => $locations,
        ]);
    }

    #[Route('/{id}', name: 'app_location_detail', requirements: ['id' => '\d+'], methods: ['GET'])]
    public function detail(Location $location): Response
    {
        return $this->render('location/detail.html.twig', [
            'location' => $location,
        ]);
    }
}
