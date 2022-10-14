<?php

namespace app\models;

class CropsModel
{
    public int $id;
    public string $name;
    public string $image;
    public string $type;

    public function setId(int $id)
    {
        $this->id = $id;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setName(int $img)
    {
        $this->img = $img;
    }

    public function getImage(): int
    {
        return $this->img;
    }

    public function setType(string $type)
    {
        $this->type = $type;
    }

    public function getType(): string
    {
        return $this->type;
    }
}