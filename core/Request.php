<?php

namespace app\core;
/**
 * Class Request
 *
 * @auther  Yash Gohel <yashgohel16@gmail.com>
 * @package app\core
 */
class Request
{
    public function getPath()
    {
        $path = $_SERVER['REQUEST_URI'] ?? '/';
        $position = strpos($path, '?');
        if ($position === false) {
            return $path;
        }
        return substr($path, 0, $position);
    }

    public function getMethod()
    {
        return $_SERVER['REQUEST_METHOD'];
    }
}