<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class AddUserController extends AbstractController
{
    #[Route('/add/user', name: 'app_add_user')]
    public function index(): Response
    {
        return $this->render('add_user/index.html.twig', [
            'controller_name' => 'AddUserController',
        ]);
    }
}
