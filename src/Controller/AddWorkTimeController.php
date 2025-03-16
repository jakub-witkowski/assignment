<?php

namespace App\Controller;

use App\Entity\WorkTime;
use App\Form\WorkTimeFormType;
use App\Repository\WorkTimeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class AddWorkTimeController extends AbstractController
{
    #[Route('/add-work-time', name: 'app_add_work_time')]
    public function index(WorkTimeRepository $repository, Request $request, EntityManagerInterface $em): Response
    {
        $form = $this->createForm(WorkTimeFormType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $startTime = $form->get('startAt')->getData();
            $endTime = $form->get('endAt')->getData();
            $employee = $form->get('employee')->getData();

            // zmienne całkowite pozwalające obliczyć czas trwania pracy
            $startTimestamp = $startTime->getTimestamp();
            $endTimestamp = $endTime->getTimestamp();

            // czas pracy wyrażony w minutach
            $durationInMinutes = ($endTimestamp - $startTimestamp) / 60;

            // Flagi pozwalające monitorować błędy w procesie dodawania czasu pracy
            $isTimeCorrect = false;
            $isStartDayCorrect = false;
            $isLessThanTwelveHours = false;

            // Czy data/godzina zakończenia nie jest wcześniejsza niż data/godzina rozpoczęcia?
            if ($endTimestamp <= $startTimestamp)
            {
                $status = [
                    'status' => 'Data/godzina zakończenia jest wcześniejsza niż data/godzina rozpoczęcia'
                ];

                return $this->json($status);
            }
            else
                $isTimeCorrect = true;
            }

            // Zapobiega tworzeniu więcej niż jednego przedziału rozpoczęcia pracy dla danego pracownika
            if ($repository->checkForStartDay($startTime->format('Y-m-d'), $employee->getId()) > 0)
            {
                $status = [
                    'status' => 'Dla wskazanego pracownika istnieje już przedział ze wskazanym dniem rozpoczęcia'
                ];

                return $this->json($status);
            }
            else
                $isStartDayCorrect = true;

            // Czy długość czasu pracy nie przekracza dziennej normy w godzinach?
            if ($durationInMinutes > WorkTime::DAILY_NORM * 60)
            {
                $status = [
                    'status' => 'Wybrany przedział jest dłuższy niż '. WorkTime::DAILY_NORM . 'h'
                ];

                return $this->json($status);
            }
            else
                $isLessThanTwelveHours = true;

            // Jeśli wszystkie warunki są spełnione, tworzy nowy obiekt klasy WorkTime
            if ($isTimeCorrect && $isLessThanTwelveHours && $isStartDayCorrect)
            {
                $workTime = new WorkTime();

                $workTime->setStartTime($startTime);
                $workTime->setEndTime($endTime);
                $workTime->setStartDay($startTime->format('Y-m-d'));
                $workTime->setStartMonth($startTime->format('Y-m'));
                $workTime->setEmployee($employee);
                $workTime->setWorkDuration($durationInMinutes);

                $em->persist($workTime);
                $em->flush();

                $status = [
                    'status' => 'Czas pracy został dodany!'
                ];

                return $this->json($status);
            }


        return $this->render('add_work_time/index.html.twig', [
            'controller_name' => 'AddWorkTimeController',
            'workTimeForm' => $form->createView(),
        ]);
    }
}
