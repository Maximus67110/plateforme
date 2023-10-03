<?php

namespace App\EventListener;

use App\Entity\User;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;
use Symfony\Component\Security\Core\Event\AuthenticationSuccessEvent;
use Symfony\Component\Security\Core\Exception\AuthenticationException;

class AuthenticationSuccessListener
{
    #[AsEventListener(event: AuthenticationSuccessEvent::class)]
    public function __invoke(AuthenticationSuccessEvent $event): void
    {
        /** @var User $user */
        $user = $event->getAuthenticationToken()->getUser();
        if (!$user->isVerified()) {
            throw new AuthenticationException("Please verify your email");
        }
    }
}