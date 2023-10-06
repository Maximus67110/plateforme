<?php

namespace App\Controller;

use App\Repository\BookingRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/booking')]
class BookingController extends AbstractController
{
    #[Route('/user', name: 'app_booking_user')]
    public function user(BookingRepository $bookingRepository): Response
    {
        $bookings = $bookingRepository->findBy(['user' => $this->getUser()]);
        return $this->render('booking/user.html.twig', [
            'bookings' => $bookings,
        ]);
    }
}
