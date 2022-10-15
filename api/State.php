<?php

namespace app\api;

use app\models\StateModel;

class State extends Api implements ApiInterface
{

    public string $table = "hc_state";

    public function __construct()
    {
    }

    public function getQuery(string $query): string
    {
        $q = [
            "add" => "INSERT INTO {$this->table} (`tag`, `name`, `country`) VALUES (?, ?, ?);",
            "getAll" => "SELECT * FROM {$this->table}",
            "getById" => "SELECT * FROM {$this->table} WHERE `id` = ?;",
            "getByTag" => "SELECT * FROM {$this->table} WHERE `tag` = ?;",
            "getByName" => "SELECT * FROM {$this->table} WHERE `name` = ?;",
            "getByCountry" => "SELECT * FROM {$this->table} WHERE `country` = ?;",
            "getByCountryName" => "SELECT * FROM {$this->table} WHERE `country` = (SELECT `id` from `hc_countries` WHERE `name` = ?);",
            "last" => "SELECT * FROM {$this->table} ORDER BY `id` DESC LIMIT 1;"
        ];
        return $q[$query];
    }

    public function last(): StateModel
    {
        $model = new StateModel();
        $sql = self::$con->prepare($this->getQuery("last"));
        $sql->execute([]);
        $res = $sql->fetch();

        if (count($res) > 0) {
            $model->setData($res);
        }
        return $model;
    }

    public function add(StateModel $model)
    {
        $sql = self::$con->prepare($this->getQuery("add"));

        try {
            $res = $sql->execute([
                $model->getTag(),
                $model->getStateName(),
                $model->getCountry()
            ]);

            if ($res) {
                $this->res = self::getResponse(200, array("msg" => "New state added", "data" => self::last()));
            } else {
                $this->res = self::getResponse(400, array("msg" => "Failed to add new state", "data" => null));
            }

        } catch (\PDOException $e) {
            $this->res = self::getResponse(400, array("msg" => "Failed to add new state", "data" => null));
        }
        self::display();
    }

    public function get(StateModel $model, string $filter)
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
                case "getByTag" :
                {
                    $sql->execute([$model->getTag()]);
                    break;
                }
                case "getByName" :
                {
                    $sql->execute([$model->getStateName()]);
                    break;
                }
                case "getByCountry" :
                {
                    $sql->execute([$model->getCountry()]);
                    break;
                }
                case "getByCountryName" :
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
            $this->res = self::getResponse(400, array("msg" => "Failed to get state", "data" => null));
        }
        self::display();
    }


    public function handle(string $request, array $param, string $filter, string $type = "")
    {
        $model = new StateModel();
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