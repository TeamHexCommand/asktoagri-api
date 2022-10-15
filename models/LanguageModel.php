<?php

namespace app\models;

class LanguageModel
{
    public int $id;
    public string $tag;
    public string $name;

    public function setData(array $ary)
    {
        $this->id = $ary['id'] ?? 0;
        $this->tag = $ary['tag'] ?? "";
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

    public function setTag(string $tag)
    {
        $this->tag = $tag;
    }

    public function getTag(): string
    {
        return $this->tag;
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