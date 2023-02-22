<?php

declare(strict_types=1);

class Classes {

    private string $name;
    private int $credits;
    private int $lectureHours;
    private int $seminarHours;
    private string $endType;


    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getEndType(): string
    {
        return $this->endType;
    }

    public function setEndType(string $endType): void
    {
        $this->endType = $endType;
    }

    public function getCredits(): int
    {
        return $this->credits;
    }

    public function setCredits(int $credits): void
    {
        $this->credits = $credits;
    }

    public function getLectureHours(): int
    {
        return $this->lectureHours;
    }

    public function setLectureHours(int $lectureHours): void
    {
        $this->lectureHours = $lectureHours;
    }

    public function getSeminarHours(): int
    {
        return $this->seminarHours;
    }

    public function setSeminarHours(int $seminarHours): void
    {
        $this->seminarHours = $seminarHours;
    }

}