<?php

namespace app\api;

use app\core\Database;
use app\models\CategoryModel;
use app\models\CountriesModel;

class Countries extends Api
{
    public string $table = "hc_countries";

    public function __construct()
    {
    }

    public function getQuery(string $query): string
    {
        $q = [
            "add" => "INSERT INTO {$this->table} (`cc`, `tag`, `name`) VALUES (?, ?, ?);",
            "getAll" => "SELECT * FROM {$this->table}",
            "getById" => "SELECT * FROM {$this->table} WHERE `id` = ?;",
            "getByCc" => "SELECT * FROM {$this->table} WHERE `cc` = ?;",
            "getByTag" => "SELECT * FROM {$this->table} WHERE `tag` = ?;",
            "getByName" => "SELECT * FROM {$this->table} WHERE `name` = ?;",
            "last" => "SELECT * FROM {$this->table} ORDER BY `id` DESC LIMIT 1;"
        ];
        return $q[$query];
    }

    public function last(): CountriesModel
    {
        $model = new CountriesModel();
        $sql = self::$con->prepare($this->getQuery("last"));
        $sql->execute([]);
        $res = $sql->fetch();

        if (count($res) > 0) {
            $model->setData($res);
        }
        return $model;
    }

    public function add(CountriesModel $model)
    {
        $sql = self::$con->prepare($this->getQuery("add"));

        try {
            $res = $sql->execute([
                $model->getCc(),
                $model->getTag(),
                $model->getCountryName()
            ]);

            if ($res) {
                $this->res = self::getResponse(200, array("msg" => "New county added", "data" => self::last()));
            } else {
                $this->res = self::getResponse(400, array("msg" => "Failed to add new country", "data" => null));
            }

        } catch (\PDOException $e) {
            $this->res = self::getResponse(400, array("msg" => "Failed to add new country", "data" => null));
        }
        self::display();
    }

    public function get(CountriesModel $model, string $filter)
    {
        $sql = self::$con->prepare($this->getQuery($filter));

        try {
            switch ($filter) {
                case "getAll" :
                {
                    $sql->execute([]);
                    break;
                }
                case "getById" :
                {
                    $sql->execute([$model->getId()]);
                    break;
                }
                case "getByCc" :
                {
                    $sql->execute([$model->getCc()]);
                    break;
                }
                case "getByTag" :
                {
                    $sql->execute([$model->getTag()]);
                    break;
                }
                case "getByName" :
                {
                    $sql->execute([$model->getCountryName()]);
                    break;
                }
            }

            $res = $sql->fetchAll();

            if ($res && count($res) > 0) {
                $this->res = self::getResponse(200, array("msg" => "Record found", "data" => $res));
            } else {
                $this->res = self::getResponse(400, array("msg" => "No records", "data" => null));
            }

        } catch (\PDOException $e) {
            $this->res = self::getResponse(400, array("msg" => "Failed to get countries", "data" => null));
        }
        self::display();
    }

    public function handle(string $request, array $param, string $filter, string $type = "")
    {
        $model = new CountriesModel();
        $model->setData($param);

        switch ($request) {
            case "add":
            {
                self::add($model);
                break;
            }
            case "get":
            {
                self::get($model, $filter);
                break;
            }
        }
    }
}