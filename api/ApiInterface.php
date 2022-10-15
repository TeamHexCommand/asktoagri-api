<?php

namespace app\api;

interface ApiInterface
{
    public function handle(string $request, array $param, string $filter, string $type = "");
}