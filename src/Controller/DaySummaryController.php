<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class DaySummaryController extends AbstractController
{
    #[Route('/day/summary', name: 'app_day_summary')]
    public function index(): Response
    {
        return $this->render('day_summary/index.html.twig', [
            'controller_name' => 'DaySummaryController',
        ]);
    }
}
