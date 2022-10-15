<?php

namespace app\models;

class UploadModel
{
    public int $id;
    public int $user;
    public string $name;
    public string $type;
    public string $createdAt;
    public string $base64;

    public function setData(array $ary)
    {
        $this->id = $ary['id'] ?? 0;
        $this->user = $ary['user'] ?? 0;
        $this->name = $ary['name'] ?? "";
        $this->type = $ary['type'] ?? "";
        $this->createdAt = $ary['createdAt'] ?? "";
        $this->base64 = $ary['base64'] ?? "";
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

    public function setType(string $type)
    {
        $this->type = $type;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setCreatedAt(string $createdAt)
    {
        $this->createdAt = $createdAt;
    }

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    public function setBase64(string $base64)
    {
        $this->base64 = $base64;
    }

    public function getBase64(): string
    {
        return $this->base64;
    }
}