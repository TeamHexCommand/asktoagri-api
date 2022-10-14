<?php

namespace app\models;

class ChatModel
{
    public int $id;
    public int $sender;
    public int $receiver;
    public string $msg;
    public int $nextMsg;
    public int $previousMsg;
    public int $file;
    public bool $isSeen;
    public bool $isDeleted;
    public string $deleteAt;
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

    public function setSender(int $sender)
    {
        $this->sender = $sender;
    }

    public function getSender(): int
    {
        return $this->sender;
    }

    public function setReceiver(int $receiver)
    {
        $this->receiver = $receiver;
    }

    public function getReceiver(): int
    {
        return $this->receiver;
    }

    public function setMsg(string $msg)
    {
        $this->msg = $msg;
    }

    public function getMsg(): string
    {
        return $this->msg;
    }

    public function setNextMsg(int $nextMsg)
    {
        $this->nextMsg = $nextMsg;
    }

    public function getNextMsg(): int
    {
        return $this->nextMsg;
    }

    public function setPreviousMsg(int $previousMsg)
    {
        $this->previousMsg = $previousMsg;
    }

    public function getPreviousMsg(): int
    {
        return $this->previousMsg;
    }

    public function setFile(int $file)
    {
        $this->file = $file;
    }

    public function getFile(): int
    {
        return $this->file;
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

    public function setDeleteAt(string $deleteAt)
    {
        $this->deleteAt = $deleteAt;
    }

    public function getDeleteAt(): string
    {
        return $this->deleteAt;
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