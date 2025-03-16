<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class MonthSummaryController extends AbstractController
{
    #[Route('/month/summary', name: 'app_month_summary')]
    public function index(): Response
    {
        return $this->render('month_summary/index.html.twig', [
            'controller_name' => 'MonthSummaryController',
        ]);
    }
}
