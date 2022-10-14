<?php

namespace app\core;
/**
 * Class Response
 *
 * @auther  Yash Gohel <yashgohel16@gmail.com>
 * @package app\core
 */
class Response
{

    public function setStatusCode(int $code)
    {
        http_response_code($code);
    }
}