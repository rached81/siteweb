<?php

namespace App\Entity;

use App\Entity\Admin;
use App\Repository\ResetPasswordRequestRepository;
use Doctrine\ORM\Mapping as ORM;
use SymfonyCasts\Bundle\ResetPassword\Model\ResetPasswordRequestInterface;

/**
 * @ORM\Entity(repositoryClass=ResetPasswordRequestRepository::class)
 */
class ResetPasswordRequest implements ResetPasswordRequestInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private ?int $id = null;

    /**
     * Compte cible de la réinitialisation
     * @ORM\ManyToOne(targetEntity=Admin::class)
     * @ORM\JoinColumn(nullable=false, onDelete="CASCADE")
     */
    private ?Admin $user = null;

    /**
     * Sélecteur public court (utilisé dans l’URL)
     * @ORM\Column(type="string", length=20)
     */
    private string $selector;

    /**
     * Jeton haché (jamais en clair)
     * @ORM\Column(type="string", length=100)
     */
    private string $hashedToken;

    /**
     * Date/heure de la demande
     * @ORM\Column(type="datetime_immutable")
     */
    private \DateTimeImmutable $requestedAt;

    /**
     * Date/heure d’expiration du token
     * @ORM\Column(type="datetime_immutable")
     */
    private \DateTimeImmutable $expiresAt;

    public function __construct(Admin $user, \DateTimeImmutable $expiresAt, string $selector, string $hashedToken)
    {
        $this->user        = $user;
        $this->requestedAt = new \DateTimeImmutable();
        $this->expiresAt   = $expiresAt;
        $this->selector    = $selector;
        $this->hashedToken = $hashedToken;
    }

    public function getId(): ?int { return $this->id; }

    // --- Méthodes exigées par l’interface ---
    public function getUser(): object { return $this->user; }
    public function getRequestedAt(): \DateTimeImmutable { return $this->requestedAt; }
    public function getExpiresAt(): \DateTimeImmutable { return $this->expiresAt; }
    public function isExpired(): bool { return $this->expiresAt <= new \DateTimeImmutable(); }
    public function getSelector(): string { return $this->selector; }
    public function getHashedToken(): string { return $this->hashedToken; }
}

