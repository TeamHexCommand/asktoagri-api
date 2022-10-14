<?php

namespace app\models;

class SolutionModel
{
    public int $id;
    public int $user;
    public string $title;
    public string $body;
    public int $file;
    public int $crops;
    public int $category;
    public int $district;
    public bool $common;
    public string $tags;
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

    public function setTitle(string $title)
    {
        $this->title = $title;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setBody(string $body)
    {
        $this->body = $body;
    }

    public function getBody(): string
    {
        return $this->body;
    }

    public function setFile(int $file)
    {
        $this->file = $file;
    }

    public function getFile(): int
    {
        return $this->file;
    }

    public function setCrops(int $crops)
    {
        $this->crops = $crops;
    }

    public function getCrops(): int
    {
        return $this->crops;
    }

    public function setCategory(int $category)
    {
        $this->category = $category;
    }

    public function getCategory(): int
    {
        return $this->category;
    }

    public function setDistrict(int $district)
    {
        $this->district = $district;
    }

    public function getDistrict(): int
    {
        return $this->district;
    }

    public function setCommon(bool $common)
    {
        $this->common = $common;
    }

    public function getCommon(): bool
    {
        return $this->common;
    }

    public function setTags(string $tags)
    {
        $this->tags = $tags;
    }

    public function getTags(): string
    {
        return $this->tags;
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