<?php

namespace app\models;

class BaseModel
{
    public int $limit;
    public string $sort;

    public function setData(array $ary)
    {
        $this->limit = $ary['limit'] ?? 0;
        $this->sort = $ary['sort'] ?? "";
    }

    public function setLimit(int $limit)
    {
        $this->limit = $limit;
    }

    public function getLimit(): int
    {
        return $this->limit;
    }

    public function setSort(string $sort)
    {
        $this->sort = $sort;
    }

    public function getSort(): string
    {
        return $this->sort;
    }
}