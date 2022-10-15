<?php

namespace app\models;

class TagsModel
{
    public int $id;
    public string $name;

    public function setData(array $ary)
    {
        $this->id = $ary['id'] ?? 0;
        $this->name = $ary['name'] ?? "";
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
}