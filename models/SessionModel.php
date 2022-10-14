<?php

namespace app\models;

class SessionModel
{
    public int $id;
    public int $user;
    public string $token;
    public int $deviceId;
    public string $ip;
    public string $createdAt;

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

    public function setToken(string $token)
    {
        $this->token = $token;
    }

    public function getToken(): string
    {
        return $this->token;
    }

    public function setDeviceId(int $deviceId)
    {
        $this->deviceId = $deviceId;
    }

    public function getDeviceId(): int
    {
        return $this->deviceId;
    }

    public function setIp(string $ip)
    {
        $this->ip = $ip;
    }

    public function getIp(): string
    {
        return $this->ip;
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