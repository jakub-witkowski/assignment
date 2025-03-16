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

    public function getNumberOfHoursInMonthToDate(string $date, string $month, int $employeeId)
    {
        $result = $this->createQueryBuilder('workTime')
            ->select('SUM(workTime.workDuration)')
            ->where('workTime.startDay < :date')
            ->setParameter('date', $date)
            ->andWhere('workTime.startMonth = :month')
            ->setParameter('month', $month)
            ->andWhere('workTime.employee = :employeeId')
            ->setParameter('employeeId', $employeeId)
            ->getQuery()
            ->getSingleScalarResult()
        ;

        return WorkTimeRepository::convertToHours($result);
    }
}
