<?php

namespace App\Entity;

use App\Repository\WorkTimeRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: WorkTimeRepository::class)]
class WorkTime
{
    // należność za nienadliczbową godzinę pracy
    const NORMAL_FEE = 20;

    // modyfikator stawki nadgodzinowej - 200%
    const OVERTIME_RATE = 2;

    // miesięczna norma nadgodzin
    const MONTHLY_NORM = 40;

    // dzienna norma godzin

    const DAILY_NORM = 12;
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'workTimes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $employee = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $startTime = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $endTime = null;

    #[ORM\Column]
    private ?int $workDuration = null;

    #[ORM\Column(length: 255)]
    private ?string $startDay = null;

    #[ORM\Column(length: 255)]
    private ?string $startMonth = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmployee(): ?User
    {
        return $this->employee;
    }

    public function setEmployee(?User $employee): static
    {
        $this->employee = $employee;

        return $this;
    }

    public function getStartTime(): ?\DateTimeInterface
    {
        return $this->startTime;
    }

    public function setStartTime(\DateTimeInterface $startTime): static
    {
        $this->startTime = $startTime;

        return $this;
    }

    public function getEndTime(): ?\DateTimeInterface
    {
        return $this->endTime;
    }

    public function setEndTime(\DateTimeInterface $endTime): static
    {
        $this->endTime = $endTime;

        return $this;
    }

    public function getWorkDuration(): ?int
    {
        return $this->workDuration;
    }

    public function setWorkDuration(int $workDuration): static
    {
        $this->workDuration = $workDuration;

        return $this;
    }

    public function getStartDay(): ?string
    {
        return $this->startDay;
    }

    public function setStartDay(string $startDay): static
    {
        $this->startDay = $startDay;

        return $this;
    }

    public function getStartMonth(): ?string
    {
        return $this->startMonth;
    }

    public function setStartMonth(string $startMonth): static
    {
        $this->startMonth = $startMonth;

        return $this;
    }
}
