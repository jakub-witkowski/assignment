<?php

namespace App\Controller;

use App\Entity\WorkTime;
use App\Form\UserWorkMonthSummaryFormType;
use App\Repository\WorkTimeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

final class MonthSummaryController extends AbstractController
{
    #[Route('/user-month-summary', name: 'app_user_month_summary')]
    public function index(Request $request, WorkTimeRepository $repository): Response
    {
        $form = $this->createForm(UserWorkMonthSummaryFormType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            $employee = $form->get('employee')->getData();
            $startMonth = $form->get('startMonth')->getData();

            // Całkowita liczba godzin przepracowanych w wybranego miesiącu
            $workHours = $repository->getUserMonthlyHours($startMonth, $employee->getId());

            // Liczba przepracowanych godzin nienadliczbowych w wybranym miesiącu
            $howManyNormalHours = 0;

            // Liczba przepracowanych godzin nadliczbowych w wybranym miesiącu
            $howManyOvertimeHours = 0;

            // Ustalenie liczby godzin nadliczbowych i normalnych
            if ($workHours > WorkTime::MONTHLY_NORM)
            {
                $howManyNormalHours = WorkTime::MONTHLY_NORM;
                $howManyOvertimeHours = $workHours - WorkTime::MONTHLY_NORM;
            }

            // Ustalenie należności za przepracowane godziny
            if ($howManyOvertimeHours === 0)
                $payment = WorkTime::NORMAL_FEE * $workHours;

            if ($howManyOvertimeHours > 0)
                $payment = ((WorkTime::OVERTIME_RATE * WorkTime::NORMAL_FEE) * $howManyOvertimeHours) + (WorkTime::NORMAL_FEE * $howManyNormalHours);

            $summary = [
                'response' => [
                    'ilość normalnych godzin z danego miesiąca' => $howManyNormalHours,
                    'stawka' => WorkTime::NORMAL_FEE . ' PLN',
                    'ilość nadgodzin z danego miesiąca' => $howManyOvertimeHours,
                    'stawka nadgodzinowa' => WorkTime::NORMAL_FEE * WorkTime::OVERTIME_RATE . ' PLN',
                    'suma po przeliczeniu' => $payment,
                ]
            ];

            return new JsonResponse($summary);
        }

        return $this->render('month_summary/index.html.twig', [
            'controller_name' => 'MonthSummaryController',
            'monthSummaryForm' => $form->createView(),
        ]);
    }
}
