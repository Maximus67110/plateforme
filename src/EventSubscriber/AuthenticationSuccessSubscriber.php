<?php

namespace App\EventSubscriber;

use App\Entity\User;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Security\Core\Event\AuthenticationSuccessEvent;
use Symfony\Component\Security\Core\Exception\AuthenticationException;

class AuthenticationSuccessSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents(): array
    {
        return [
//            AuthenticationSuccessEvent::class => 'onAuthenticationSuccess'
        ];
    }

    public function onAuthenticationSuccess(AuthenticationSuccessEvent $event): void
    {
        /** @var User $user */
        $user = $event->getAuthenticationToken()->getUser();
        if (!$user->isVerified()) {
            throw new AuthenticationException("Please verify your email");
        }
    }
}