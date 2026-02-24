<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\User;
//use Doctrine\ORM\EntityManagerInterface;
use App\Model\UserModel;

class UserController extends AbstractController
{
    //public function list(EntityManagerInterface $em): Response
    public function list(UserModel $userModel): Response
    {
        //$users = $em->getRepository(User::class)->findAll();
        $users = $userModel->getAllUsers();

        return $this->render('User/list.html.twig', [
            'users' => $users,
        ]);
    }
}
