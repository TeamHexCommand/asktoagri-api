<?php

namespace app\api;

use app\models\CityModel;

class City extends Api implements ApiInterface
{
    public string $table = "hc_city";

    public function __construct()
    {
    }

    public function getQuery(string $query): string
    {
        $q = [
            "add" => "INSERT INTO {$this->table} (`name`, `pincode`,`district`) VALUES (?, ?, ?);",
            "getAll" => "SELECT * FROM {$this->table}",
            "getById" => "SELECT * FROM {$this->table} WHERE `id` = ?;",
            "getByPincode" => "SELECT * FROM {$this->table} WHERE `pincode` = ?;",
            "getByName" => "SELECT * FROM {$this->table} WHERE `name` = ?;",
            "getByDistrict" => "SELECT * FROM {$this->table} WHERE `district` = ?;",
            "getByDistrictName" => "SELECT * FROM {$this->table} WHERE `district` = (SELECT `id` from `hc_district` WHERE `name` = ?);",
            "last" => "SELECT * FROM {$this->table} ORDER BY `id` DESC LIMIT 1;"
        ];
        return $q[$query];
    }

    public function last(): CityModel
    {
        $model = new CityModel();
        $sql = self::$con->prepare($this->getQuery("last"));
        $sql->execute([]);
        $res = $sql->fetch();

        if (count($res) > 0) {
            $model->setData($res);
        }
        return $model;
    }

    public function add(CityModel $model)
    {
        $sql = self::$con->prepare($this->getQuery("add"));

        try {
            $res = $sql->execute([
                $model->getName(),
                $model->getPincode(),
                $model->getDistrict()
            ]);

            if ($res) {
                $this->res = self::getResponse(200, array("msg" => "New city added", "data" => self::last()));
            } else {
                $this->res = self::getResponse(400, array("msg" => "Failed to add new city", "data" => null));
            }

        } catch (\PDOException $e) {
            $this->res = self::getResponse(400, array("msg" => "Failed to add new city", "data" => null));
        }
        self::display();
    }

    public function get(CityModel $model, string $filter)
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
                case "getByPincode" :
                {
                    $sql->execute([$model->getPincode()]);
                    break;
                }
                case "getByName" :
                {
                    $sql->execute([$model->getName()]);
                    break;
                }
                case "getByDistrict" :
                {
                    $sql->execute([$model->getDistrict()]);
                    break;
                }
                case "getByDistrictName" :
                {
                    $sql->execute([$model->getDistrictName()]);
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
            $this->res = self::getResponse(400, array("msg" => "Failed to get city", "data" => null));
        }
        self::display();
    }


    public function handle(string $request, array $param, string $filter, string $type = "")
    {
        $model = new CityModel();
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