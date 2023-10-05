<?php

namespace App\Controller;

use App\Entity\Location;
use App\Entity\Room;
use App\Form\RoomType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RoomController extends AbstractController
{
    #[Route('/{id}/room', name: 'app_room_list')]
    public function list(Location $location): Response
    {
        return $this->render('room/list.html.twig', [
            'location' => $location
        ]);
    }

    #[Route('/{id}/room/new', name: 'app_room_new')]
    public function new(Location $location, Request $request, EntityManagerInterface $entityManager): Response
    {
        $room = new Room();
        $room->setLocation($location);
        $form = $this->createForm(RoomType::class, $room);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($room);
            $entityManager->flush();
            return $this->redirectToRoute('app_room_list', ['id' => $location->getId()]);
        }
        return $this->render('room/new.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/room/{id}/edit', name: 'app_room_edit')]
    public function edit(Room $room, Request $request, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(RoomType::class, $room);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($room);
            $entityManager->flush();
            return $this->redirectToRoute('app_room_list', ['id' => $room->getLocation()?->getId()]);
        }
        return $this->render('room/edit.html.twig', [
            'form' => $form,
            'room' => $room,
        ]);
    }

    #[Route('room/{id}/delete', name: 'app_room_delete')]
    public function delete(Room $room, EntityManagerInterface $entityManager): Response
    {
        $entityManager->remove($room);
        $entityManager->flush();
        return $this->redirectToRoute('app_room_list', ['id' => $room->getLocation()?->getId()]);
    }
}
