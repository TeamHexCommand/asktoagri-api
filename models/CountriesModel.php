<?php

namespace app\models;

class CountriesModel
{
    public int $id;
    public int $cc;
    public string $tag;
    public string $name;

    public function setId(int $id)
    {
        $this->id = $id;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setCc(int $cc)
    {
        $this->cc = $cc;
    }

    public function getCc(): int
    {
        return $this->cc;
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