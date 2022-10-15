<?php

namespace app\core;

class Database
{
    public \PDO $pdo;
    private static $dsn;
    private static $user;
    private static $password;
    private static $con;

    public function __construct(array $config)
    {
        self::$dsn = $config['dsn'] ?? '';
        self::$user = $config['user'] ?? '';
        self::$password = $config['password'] ?? '';
    }

    public function connect()
    {
        if (self::$con == null) {
            self::$con = new \PDO(self::$dsn, self::$user, self::$password);
            self::$con->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            self::$con->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
            self::$con->exec("SET CHARACTER SET utf8");
            return self::$con;
        }
    }
}