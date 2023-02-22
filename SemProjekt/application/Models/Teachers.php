<?php

declare(strict_types=1);

class Teachers {

    private string $id;
    private string $name;
    private string $surname;
    private string $titleBefore;
    private string $titleAfter;

    function __construct(string $id, string $name, string $surname, string $titleBefore, string $titleAfter) {
        $this->id = $id;
        $this->name = $name;
        $this->surname = $surname;
        $this->titleBefore = $titleBefore;
        $this->titleAfter = $titleAfter;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): void
    {
        $this->id = $id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }


    public function getSurname(): string
    {
        return $this->surname;
    }

    public function setSurname(string $surname): void
    {
        $this->surname = $surname;
    }

    public function getTitleBefore(): string
    {
        return $this->titleBefore;
    }

    public function setTitleBefore(string $titleBefore): void
    {
        $this->titleBefore = $titleBefore;
    }

    public function getTitleAfter(): string
    {
        return $this->titleAfter;
    }

    public function setTitleAfter(string $titleAfter): void
    {
        $this->titleAfter = $titleAfter;
    }

}