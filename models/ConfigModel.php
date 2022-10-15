<?php

namespace app\models;

class ConfigModel
{
    public int $id;
    public int $user;
    public string $name;
    public string $value;
    public string $updatedAt;
    public string $createdAt;

    public function setData(array $ary)
    {
        $this->id = $ary['id'] ?? 0;
        $this->user = $ary['user'] ?? 0;
        $this->name = $ary['name'] ?? '';
        $this->value = $ary['value'] ?? '';
        $this->updateAt = $ary['updateAt'] ?? "";
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

    public function setName(string $name)
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setValue(string $value)
    {
        $this->value = $value;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function setUpdatedAt(string $updatedAt)
    {
        $this->updatedAt = $updatedAt;
    }

    public function getUpdatedAt(): string
    {
        return $this->updatedAt;
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