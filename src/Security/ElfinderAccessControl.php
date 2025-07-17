<?php


namespace App\Security;

use Symfony\Component\Security\Core\Security;

class ElfinderAccessControl
{
    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    public function access($attr, $path, $data, $volume)
    {
        return strpos(basename($path), '.') === 0 // interdit les fichiers cachés
            ? !($attr == 'read' || $attr == 'write')
            : $this->security->isGranted('ROLE_EDITOR'); // ou le rôle que vous voulez
    }
}