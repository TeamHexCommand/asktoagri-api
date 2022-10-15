<?php

namespace app\models;

class DistrictModel extends StateModel
{
    public int $id;
    public string $districtName;
    public int $state;

    public function setData(array $ary)
    {
        $this->id = $ary['id'] ?? 0;
        $this->state = $ary['state'] ?? 0;
        $this->districtName = $ary['districtName'] ?? "";
        self::setStateName($ary['stateName'] ?? "");
    }

    public function setId(int $id)
    {
        $this->id = $id;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setDistrictName(string $name)
    {
        $this->districtName = $name;
    }

    public function getDistrictName(): string
    {
        return $this->districtName;
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