<?php

namespace App\Repository;

use App\Entity\ResetPasswordRequest;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class ResetPasswordRequestRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ResetPasswordRequest::class);
    }

    // Ajoute des méthodes utiles si besoin, ex :
    // public function deleteExpired(\DateTimeImmutable $now): int
    // {
    //     return $this->createQueryBuilder('r')
    //         ->delete()
    //         ->where('r.expiresAt <= :now')
    //         ->setParameter('now', $now)
    //         ->getQuery()
    //         ->execute();
    // }
}
