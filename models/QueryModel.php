<?php

namespace app\models;

class QueryModel
{
    public int $id;
    public int $user;
    public string $title;
    public string $body;
    public int $file;
    public int $crops;
    public int $category;
    public int $district;
    public bool $resolved;
    public bool $spam;
    public string $tags;
    public int $solution;
    public string $createdAt;

    public function setData(array $ary)
    {
        $this->id = $ary['id'] ?? 0;
        $this->user = $ary['user'] ?? 0;
        $this->title = $ary['title'] ?? "";
        $this->body = $ary['body'] ?? "";
        $this->file = $ary['file'] ?? 0;
        $this->crops = $ary['crops'] ?? 0;
        $this->category = $ary['category'] ?? 0;
        $this->district = $ary['district'] ?? 0;
        $this->resolved = $ary['resolved'] ?? false;
        $this->spam = $ary['spam'] ?? false;
        $this->tags = $ary['tags'] ?? "";
        $this->solution = $ary['solution'] ?? 0;
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

    public function setResolved(bool $resolved)
    {
        $this->resolved = $resolved;
    }

    public function getResolved(): bool
    {
        return $this->resolved;
    }

    public function setSpam(bool $spam)
    {
        $this->spam = $spam;
    }

    public function getSpam(): bool
    {
        return $this->spam;
    }

    public function setTags(string $tags)
    {
        $this->tags = $tags;
    }

    public function getTags(): string
    {
        return $this->tags;
    }

    public function setSolution(int $solution)
    {
        $this->solution = $solution;
    }

    public function getSolution(): int
    {
        return $this->solution;
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