<?php

namespace app\models;

class StateModel extends CountriesModel
{
    public int $id;
    public string $tag;
    public string $stateName;
    public int $country;

    public function setData(array $ary)
    {
        $this->id = $ary['id'] ?? 0;
        $this->tag = $ary['tag'] ?? "";
        $this->stateName = $ary['stateName'] ?? "";
        $this->country = $ary['country'] ?? 0;
        self::setCountryName($ary['countryName'] ?? "");
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

    public function setStateName(string $name)
    {
        $this->stateName = $name;
    }

    public function getStateName(): string
    {
        return $this->stateName;
    }

    public function setCountry(int $country)
    {
        $this->country = $country;
    }

    public function getCountry(): int
    {
        return $this->country;
    }
}