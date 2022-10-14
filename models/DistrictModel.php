<?php

namespace app\models;

class DistrictModel
{
    public int $id;
    public string $name;
    public int $state;

    public function setId(int $id)
    {
        $this->id = $id;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setName(string $name)
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setState(int $state)
    {
        $this->state = $state;
    }

    public function getState(): int
    {
        return $this->state;
    }
}