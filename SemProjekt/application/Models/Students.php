<?php

declare(strict_types=1);

class Students {

    private string $id;
    private string $name;
    private string $surname;

    function __construct(string $id, string $name, string $surname) {
        $this->id = $id;
        $this->name = $name;
        $this->surname = $surname;
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


}