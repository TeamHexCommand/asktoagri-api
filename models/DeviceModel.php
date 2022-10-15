<?php

namespace app\models;

class DeviceModel
{
    public int $id;
    public int $user;
    public string $defaultFcm;
    public string $deviceId;
    public string $createdAt;

    public function setData(array $ary)
    {
        $this->id = $ary['id'] ?? 0;
        $this->user = $ary['user'] ?? 0;
        $this->defaultFcm = $ary['defaultFcm'] ?? "";
        $this->deviceId = $ary['deviceId'] ?? "";
        $this->createdAt = $ary['createdAt'] ?? "";
    }

    public function setId(int $id)
    {
        $this->id = $id;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setUser(int $user)
    {
        $this->user = $user;
    }

    public function getUser(): int
    {
        return $this->user;
    }

    public function setDefaultFcm(string $defaultFcm)
    {
        $this->defaultFcm = $defaultFcm;
    }

    public function getDefaultFcm(): string
    {
        return $this->defaultFcm;
    }

    public function setDeviceId(string $deviceId)
    {
        $this->deviceId = $deviceId;
    }

    public function getDeviceId(): string
    {
        return $this->deviceId;
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