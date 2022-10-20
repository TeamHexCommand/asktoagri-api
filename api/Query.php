<?php

namespace app\api;

use app\models\QueryModel;

class Query extends Api implements ApiInterface
{
    public string $table = "hc_query";

    public function __construct()
    {
    }

    public function getQuery(string $query): string
    {
        $q = [
            "add" => "INSERT INTO {$this->table} (`user`,`type`,`title`,`body`,`file`,`crops`,`category`,`district`) VALUES (?,?,?,?,?,?,?,?);",
            "getAll" => "SELECT * FROM {$this->table}",
            "getById" => "SELECT * FROM {$this->table} WHERE `id` = ?;",
            "getByUser" => "SELECT * FROM {$this->table} WHERE `user` = ? ORDER BY `id` DESC LIMIT 20;",
            "getByUserResolved" => "SELECT * FROM {$this->table} WHERE `user` = ? and `resolved` = 1;",
            "getByUserNotResolved" => "SELECT * FROM {$this->table} WHERE `user` = ? and `resolved` = 0;",
            "getByResolved" => "SELECT * FROM {$this->table} WHERE `resolved` = 1;",
            "getByNotResolved" => "SELECT * FROM {$this->table} WHERE `resolved` = 0 ORDER BY `id` DESC LIMIT 20;",
            "getByTitle" => "SELECT * FROM {$this->table} WHERE `title` = ?;",
            "getByCrops" => "SELECT * FROM {$this->table} WHERE `crops` = ?;",
            "getByCropsResolved" => "SELECT * FROM {$this->table} WHERE `crops` = ? and `resolved` = 1;",
            "getByCropsNotResolved" => "SELECT * FROM {$this->table} WHERE `crops` = ? and `resolved` = 0;",
            "getByCategory" => "SELECT * FROM {$this->table} WHERE `category` = ?;",
            "getByCategoryResolved" => "SELECT * FROM {$this->table} WHERE `category` = ? and `resolved` = 1;",
            "getByCategoryNotResolved" => "SELECT * FROM {$this->table} WHERE `category` = ? and `resolved` = 0;",
            "getByDistrict" => "SELECT * FROM {$this->table} WHERE `district` = ?;",
            "getByDistrictResolved" => "SELECT * FROM {$this->table} WHERE `district` = ? and `resolved` = 1;",
            "getByDistrictNotResolved" => "SELECT * FROM {$this->table} WHERE `district` = ? and `resolved` = 0;",
            "updateSolution" => "UPDATE {$this->table} SET `resolved` = 1, `solution` = ? WHERE `id` = ?;",
            "last" => "SELECT * FROM {$this->table} ORDER BY `id` DESC LIMIT 1;"
        ];
        return $q[$query];
    }

    public function last(): QueryModel
    {
        $model = new QueryModel();
        $sql = self::$con->prepare($this->getQuery("last"));
        $sql->execute([]);
        $res = $sql->fetch();

        if (count($res) > 0) {
            $model->setData($res);
        }
        return $model;
    }

    public function add(QueryModel $model)
    {
        $sql = self::$con->prepare($this->getQuery("add"));

        try {
            $res = $sql->execute([
                $model->getUser(),
                $model->getType(),
                $model->getTitle(),
                $model->getBody(),
                $model->getFile(),
                $model->getCrops(),
                $model->getCategory(),
                $model->getDistrict()
            ]);

            if ($res) {
                $this->res = self::getResponse(200, array("msg" => "New query added", "data" => self::last()));
            } else {
                $this->res = self::getResponse(400, array("msg" => "Failed to add new query", "data" => null));
            }

        } catch (\PDOException $e) {
            $this->res = self::getResponse(400, array("msg" => "Failed to add new query", "data" => null));
        }
        self::display();
    }

    public function get(QueryModel $model, string $filter)
    {
        $sql = self::$con->prepare($this->getQuery($filter));

        try {
            switch ($filter) {
                case "getByResolved":
                case "getByNotResolved":
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
                case "getByUserResolved":
                case "getByUserNotResolved":
                case "getByUser" :
                {
                    $sql->execute([$model->getUser()]);
                    break;
                }
                case "getByTitle" :
                {
                    $sql->execute([$model->getTitle()]);
                    break;
                }
                case "getByCropsResolved":
                case "getByCropsNotResolved":
                case "getByCrops" :
                {
                    $sql->execute([$model->getCrops()]);
                    break;
                }
                case "getByCategoryResolved":
                case "getByCategoryNotResolved":
                case "getByCategory" :
                {
                    $sql->execute([$model->getCategory()]);
                    break;
                }
                case "getByDistrictResolved":
                case "getByDistrictNotResolved":
                case "getByDistrict" :
                {
                    $sql->execute([$model->getDistrict()]);
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
            $this->res = self::getResponse(400, array("msg" => "Failed to get query", "data" => null));
        }
        self::display();
    }

    public function update(QueryModel $model, string $filter)
    {
        $sql = self::$con->prepare($this->getQuery($filter));

        try {
            switch ($filter) {
                case "updateSolution" :
                {
                    $this->exec = $sql->execute([$model->getSolution(), $model->getId()]);
                    break;
                }
            }

            if ($this->exec) {
                $this->res = self::getResponse(200, array("msg" => "Record updated", "data" => null));
            } else {
                $this->res = self::getResponse(400, array("msg" => "No records", "data" => null));
            }

        } catch (\PDOException $e) {
            $this->res = self::getResponse(400, array("msg" => "Failed to update record", "data" => null));
        }
        self::display();
    }


    public function handle(string $request, array $param, string $filter, string $type = "")
    {
        $model = new QueryModel();
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
            case "update":
            {
                self::update($model, $filter);
                break;
            }
        }
    }
}