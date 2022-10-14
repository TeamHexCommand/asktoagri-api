<?php

namespace app\models;

class UserModel
{
    public int $id;
    public string $firstName;
    public string $lastName;
    public string $email;
    public string $password;
    public string $firebaseId;
    public string $defaultFcm;
    public string $mobile;
    public bool $isAdmin;
    public bool $isExpert;
    public bool $isBanned;
    public string $longitude;
    public string $latitude;
    public int $defaultLang;
    public int $city;
    public string $createdAt;

    public function setId(int $id)
    {
        $this->id = $id;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setFirstName(string $firstName)
    {
        $this->firebaseId = $firstName;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function setLastName(string $lastName)
    {
        $this->lastName = $lastName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function setEmail(string $email)
    {
        $this->email = $email;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setPassword(string $password)
    {
        $this->password = $password;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setDefaultFcm(string $defaultFcm)
    {
        $this->defaultFcm = $defaultFcm;
    }

    public function getDefaultFcm(): string
    {
        return $this->defaultFcm;
    }

    public function setMobile(string $mobile)
    {
        $this->mobile = $mobile;
    }

    public function getMobile(): string
    {
        return $this->mobile;
    }

    public function setIsAdmin(bool $isAdmin)
    {
        $this->isAdmin = $isAdmin;
    }

    public function getIsAdmin(): bool
    {
        return $this->isAdmin;
    }

    public function setIsExpert(bool $isExpert)
    {
        $this->isExpert = $isExpert;
    }

    public function getIsExpert(): bool
    {
        return $this->isExpert;
    }

    public function setIsBanned(bool $isBanned)
    {
        $this->isBanned = $isBanned;
    }

    public function getIsBanned(): bool
    {
        return $this->isBanned;
    }

    public function setLongitude(string $longitude)
    {
        $this->longitude = $longitude;
    }

    public function getLongitude(): string
    {
        return $this->longitude;
    }

    public function setLatitude(string $latitude)
    {
        $this->latitude = $latitude;
    }

    public function getLatitude(): string
    {
        return $this->latitude;
    }

    public function setDefaultLang(int $defaultLang)
    {
        $this->defaultLang = $defaultLang;
    }

    public function getDefaultLang(): int
    {
        return $this->defaultLang;
    }

    public function setCity(int $city)
    {
        $this->city = $city;
    }

    public function getCity(): int
    {
        return $this->city;
    }

    public function setCreatedAt(string $createdAt)
    {
        $this->createdAt = $createdAt;
    }

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }
}