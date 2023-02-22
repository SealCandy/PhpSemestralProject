<?php

declare(strict_types=1);

class Terms {

    private int $id;
    private string $roomId;
    private string $teacherId;
    private string $classId;
    private string $date;
    private int $maximumCapacity;
    private string $note;

    public function __construct(string $roomId,  string $classId,  string $date, int $maximumCapacity, 
    string $note)
    {
        $this->roomId = $roomId;
        $this->classId = $classId;
        $this->date = $date;
        $this->maximumCapacity = $maximumCapacity;
        $this->note = $note;
    }
    public function getId(): int
    {
        return $this->id;
    }
    public function setId($id): void
    {
        $this->id = $id;
    }
    public function getRoomId(): string
    {
        return $this->roomId;
    }

    public function setRoomId(string $roomId): void
    {
        $this->roomId = $roomId;
    }

    public function getTeacherId(): string
    {
        return $this->teacherId;
    }

    public function setTeacherId(string $teacherId): void
    {
        $this->teacherId = $teacherId;
    }

    public function getClassId(): string
    {
        return $this->classId;
    }

    public function setClassId(string $classId): void
    {
        $this->classId = $classId;
    }

    public function getMaximumCapacity(): int
    {
        return $this->maximumCapacity;
    }

    public function setMaximumCapacity(int $maximumCapacity): void
    {
        $this->maximumCapacity = $maximumCapacity;
    }

    public function getDate(): string
    {
        return $this->date;
    }

    public function setDate(string $date): void
    {
        $this->date = $date;
    }

    public function getNote(): string
    {
        return $this->note;
    }

    public function setNote(string $note): void
    {
        $this->note = $note;
    }

}