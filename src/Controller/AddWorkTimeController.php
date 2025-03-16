<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class AddWorkTimeController extends AbstractController
{
    #[Route('/add/work/time', name: 'app_add_work_time')]
    public function index(): Response
    {
        return $this->render('add_work_time/index.html.twig', [
            'controller_name' => 'AddWorkTimeController',
        ]);
    }
}
