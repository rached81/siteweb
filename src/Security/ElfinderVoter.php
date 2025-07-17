<?php

namespace App\Security;

use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\Security;

class ElfinderVoter extends Voter
{
    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    protected function supports(string $attribute, $subject): bool
    {
        return strpos($attribute, 'elfinder') === 0;
    }

    protected function voteOnAttribute(string $attribute, $subject, TokenInterface $token): bool
    {
        // Autorise tout utilisateur authentifié
        return $this->security->getUser() !== null;
    }
}