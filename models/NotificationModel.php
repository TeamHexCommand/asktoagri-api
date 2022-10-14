<?php

namespace app\models;

class NotificationModel
{
    public int $id;
    public int $user;
    public string $title;
    public string $body;
    public int $image;
    public string $action;
    public bool $isSeen;
    public bool $isDeleted;
    public string $seenAt;
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

    public function setImage(int $image)
    {
        $this->image = $image;
    }

    public function getImage(): int
    {
        return $this->image;
    }

    public function setAction(string $action)
    {
        $this->action = $action;
    }

    public function getAction(): string
    {
        return $this->action;
    }

    public function setIsSeen(bool $isSeen)
    {
        $this->isSeen = $isSeen;
    }

    public function getIsSeen(): bool
    {
        return $this->isSeen;
    }

    public function setIsDeleted(bool $isDeleted)
    {
        $this->isDeleted = $isDeleted;
    }

    public function getIsDeleted(): bool
    {
        return $this->isDeleted;
    }

    public function setSeenAt(string $seenAt)
    {
        $this->seenAt = $seenAt;
    }

    public function getSeenAt(): string
    {
        return $this->seenAt;
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