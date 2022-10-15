<?php

namespace app\models;

class CityModel extends DistrictModel
{
    public int $id;
    public string $name;
    public string $pincode;
    public int $district;

    public function setData(array $ary)
    {
        $this->id = $ary['id'] ?? 0;
        $this->district = $ary['district'] ?? 0;
        $this->name = $ary['name'] ?? "";
        $this->pincode = $ary['pincode'] ?? "";
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

    public function setPincode(string $pincode)
    {
        $this->pincode = $pincode;
    }

    public function getPincode(): string
    {
        return $this->pincode;
    }

    public function setDistrict(int $district)
    {
        $this->district = $district;
    }

    public function getDistrict(): int
    {
        return $this->district;
    }
}