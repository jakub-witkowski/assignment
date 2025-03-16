<?php

namespace App\Repository;

use App\Entity\WorkTime;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<WorkTime>
 */
class WorkTimeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, WorkTime::class);
    }

    // Zaokrągla czas pracy wg wytycznych; wynik zwraca w godzinach
    public function convertToHours($workDurationInMinutes)
    {
        $workDurationInMinutesApproximate = $workDurationInMinutes % 60;

        if ($workDurationInMinutesApproximate <= 15)
            $workHours = ($workDurationInMinutes - $workDurationInMinutesApproximate) / 60;
        else if ($workDurationInMinutesApproximate > 16 && $workDurationInMinutesApproximate <= 45)
            $workHours = (($workDurationInMinutes - $workDurationInMinutesApproximate) / 60) + 0.5;
        else if ($workDurationInMinutesApproximate > 45 && $workDurationInMinutesApproximate < 60)
            $workHours = (($workDurationInMinutes - $workDurationInMinutesApproximate) / 60) + 1;

        return $workHours;
    }

    // Zwraca liczbę przedziałów rozpoczęcia pracy dla danego pracownika
    public function checkForStartDay(string $date, int $employeeId)
    {
        return $this->createQueryBuilder('workTime')
            ->select('COUNT(workTime.id)')
            ->where('workTime.startDay = :date')
            ->setParameter('date', $date)
            ->andWhere('workTime.employee = :employeeId')
            ->setParameter('employeeId', $employeeId)
            ->getQuery()
            ->getSingleScalarResult();
        ;
    }

    // Zwraca liczbę godzin przepracowanych przez danego pracownika danego dnia
    public function getUserDailyHours(string $date, int $employeeId)
    {
        $result = $this->createQueryBuilder('workTime')
            ->select('workTime.workDuration')
            ->where('workTime.startDay = :date')
            ->setParameter('date', $date)
            ->andWhere('workTime.employee = :employeeId')
            ->setParameter('employeeId', $employeeId)
            ->getQuery()
            ->getOneOrNullResult()
        ;

        if ($result === null)
            return 0;
        else
            return WorkTimeRepository::convertToHours($result['workDuration']);
    }

    // Zwraca liczbę godzin przepracowanych przez danego pracownika w danym miesiącu
    public function getUserMonthlyHours(string $month, int $employeeId)
    {
        $result = $this->createQueryBuilder('workTime')
            ->select('SUM(workTime.workDuration)')
            ->where('workTime.startMonth = :month')
            ->setParameter('month', $month)
            ->andWhere('workTime.employee = :employeeId')
            ->setParameter('employeeId', $employeeId)
            ->getQuery()
            ->getOneOrNullResult()
        ;

        if ($result === null)
            return 0;
        else
            return WorkTimeRepository::convertToHours($result['1']);
    }
}
