<?php

namespace app\models;

class CountriesModel extends \app\models\BaseModel
{
    public int $id;
    public int $cc;
    public string $tag;
    public string $countryName;

    public function __construct()
    {
    }

    public function setData(array $ary)
    {
        $this->id = $ary['id'] ?? 0;
        $this->cc = $ary['cc'] ?? 0;
        $this->tag = $ary['tag'] ?? "";
        $this->countryName = $ary['countryName'] ?? "";
    }

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

    public function setCountryName(string $name)
    {
        $this->countryName = $name;
    }

    public function getCountryName(): string
    {
        return $this->countryName;
    }
}