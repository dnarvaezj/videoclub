<?php

namespace App\Controller;

use App\Entity\Users;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;

class UserController extends AbstractController
{
    #[Route('/user', name: 'app_user')]
    public function getUsers(ManagerRegistry $doctrine): Response {

        $listUsers = $doctrine->getRepository(Users::class)->findBy([], ['fullName' => 'ASC']);
        return $this->render('user/index.html.twig',[ 'listUsers' => $listUsers ]);
    }
}
