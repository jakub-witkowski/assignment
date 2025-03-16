<?php

namespace App\Controller;

use App\Entity\WorkTime;
use App\Form\UserWorkDaySummaryFormType;
use App\Repository\WorkTimeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

final class DaySummaryController extends AbstractController
{
    #[Route('/user-day-summary', name: 'app_user_day_summary')]
    public function index(Request $request, WorkTimeRepository $repository): Response
    {
        $form = $this->createForm(UserWorkDaySummaryFormType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            $employee = $form->get('employee')->getData();
            $startDay = $form->get('startDay')->getData();

            // Liczba godzin przepracowanych wybranego dnia
            $workHours = $repository->getUserDailyHours($startDay, $employee->getId());

            // Ustalenie należności
            $payment = $workHours * WorkTime::NORMAL_FEE;

            $summary = [
                'response' => [
                    'suma po przeliczeniu' => $payment . ' PLN',
                    'ilość godzin z danego dnia' => $workHours,
                    'stawka' => WorkTime::NORMAL_FEE,
                    ]
            ];

            return new JsonResponse($summary);
        }

        return $this->render('day_summary/index.html.twig', [
            'controller_name' => 'DaySummaryController',
            'daySummaryForm' => $form->createView(),
        ]);
    }
}
