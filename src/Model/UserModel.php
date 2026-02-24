<?php

namespace App\Model;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;

class UserModel
{
    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * Pobiera wszystkich użytkowników
     *
     * @return User[]
     */
    public function getAllUsers(): array
    {
        return $this->em->getRepository(User::class)->findAll();
    }

    /**
     * Przykład: filtr użytkowników po nazwisku
     *
     * @param string $surname
     * @return User[]
     */
    public function getUsersBySurname(string $surname): array
    {
        return $this->em->getRepository(User::class)->findBy([
            'surname' => $surname
        ]);
    }
}
