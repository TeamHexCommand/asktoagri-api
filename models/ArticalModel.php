<?php

namespace app\models;

class ArticalModel
{
    public int $id;
    public int $user;
    public string $title;
    public int $category;
    public string $tags;
    public string $name;
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

    public function setCategory(string $category)
    {
        $this->category = $category;
    }

    public function getCategory(): string
    {
        return $this->category;
    }

    public function setTags(string $tags)
    {
        $this->tags = $tags;
    }

    public function getTags(): string
    {
        return $this->tags;
    }

    public function setName(string $name)
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
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