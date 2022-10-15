<?php

namespace app\models;

class CropsModel
{
    public int $id;
    public string $name;
    public int $image;
    public string $type;

    public function setData(array $ary)
    {
        $this->id = $ary['id'] ?? 0;
        $this->name = $ary['name'] ?? '';
        $this->image = $ary['image'] ?? 0;
        $this->type = $ary['type'] ?? '';
    }

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

    public function setImage(int $img)
    {
        $this->image = $img;
    }

    public function getImage(): int
    {
        return $this->image;
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