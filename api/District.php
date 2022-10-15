<?php

namespace app\api;

use app\models\DistrictModel;

class District extends Api implements ApiInterface
{
    public string $table = "hc_district";

    public function __construct()
    {
    }

    public function getQuery(string $query): string
    {
        $q = [
            "add" => "INSERT INTO {$this->table} (`name`, `state`) VALUES (?, ?);",
            "getAll" => "SELECT * FROM {$this->table}",
            "getById" => "SELECT * FROM {$this->table} WHERE `id` = ?;",
            "getByName" => "SELECT * FROM {$this->table} WHERE `name` = ?;",
            "getByState" => "SELECT * FROM {$this->table} WHERE `state` = ?;",
            "getByStateName" => "SELECT * FROM {$this->table} WHERE `state` = (SELECT `id` from `hc_state` WHERE `name` = ?);",
            "last" => "SELECT * FROM {$this->table} ORDER BY `id` DESC LIMIT 1;"
        ];
        return $q[$query];
    }

    public function last(): DistrictModel
    {
        $model = new DistrictModel();
        $sql = self::$con->prepare($this->getQuery("last"));
        $sql->execute([]);
        $res = $sql->fetch();

        if (count($res) > 0) {
            $model->setData($res);
        }
        return $model;
    }

    public function add(DistrictModel $model)
    {
        $sql = self::$con->prepare($this->getQuery("add"));

        try {
            $res = $sql->execute([
                $model->getDistrictName(),
                $model->getState()
            ]);

            if ($res) {
                $this->res = self::getResponse(200, array("msg" => "New district added", "data" => self::last()));
            } else {
                $this->res = self::getResponse(400, array("msg" => "Failed to add new district", "data" => null));
            }

        } catch (\PDOException $e) {
            $this->res = self::getResponse(400, array("msg" => "Failed to add new district", "data" => null));
        }
        self::display();
    }

    public function get(DistrictModel $model, string $filter)
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
                case "getByName" :
                {
                    $sql->execute([$model->getDistrictName()]);
                    break;
                }
                case "getByState" :
                {
                    $sql->execute([$model->getState()]);
                    break;
                }
                case "getByStateName" :
                {
                    $sql->execute([$model->getStateName()]);
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
            $this->res = self::getResponse(400, array("msg" => "Failed to get district", "data" => null));
        }
        self::display();
    }


    public function handle(string $request, array $param, string $filter, string $type = "")
    {
        $model = new DistrictModel();
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