<?php

namespace App\EventListener;

use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Security\Core\Security;
class ElfinderAuthListener
{
    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    public function onKernelRequest(RequestEvent $event)
    {
        $request = $event->getRequest();

        // Liste des routes elFinder à protéger
        $elfinderRoutes = ['/efconnect', '/elfinder'];

        foreach ($elfinderRoutes as $route) {
            if (strpos($request->getPathInfo(), $route) === 0) {
                // Vérifie si l'utilisateur a au moins un rôle (est connecté)
//                if (!$this->security->getUser()) {
//                    throw new AccessDeniedException('Vous devez être connecté');
//                }
                break;
            }
        }
    }
}
