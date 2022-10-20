<?php

namespace app\api;

use app\models\SolutionModel;

class Solution extends Api implements ApiInterface
{
    public string $table = "hc_solution";

    public function __construct()
    {
    }

    public function getQuery(string $query): string
    {
        $q = [
            "add" => "INSERT INTO {$this->table} (`user`,`type`,`title`,`body`,`file`,`crops`,`category`,`district`,`common`) VALUES (?,?,?,?,?,?,?,?,?);",
            "getAll" => "SELECT * FROM {$this->table}",
            "getById" => "SELECT * FROM {$this->table} WHERE `id` = ?;",
            "getByUser" => "SELECT * FROM {$this->table} WHERE `user` = ?;",
            "getByTitle" => "SELECT * FROM {$this->table} WHERE `title` = ?;",
            "getByCrops" => "SELECT * FROM {$this->table} WHERE `crops` = ?;",
            "getByCategory" => "SELECT * FROM {$this->table} WHERE `category` = ?;",
            "getByDistrict" => "SELECT * FROM {$this->table} WHERE `district` = ?;",
            "getByCommon" => "SELECT * FROM {$this->table} WHERE `common` = ?;",
            "last" => "SELECT * FROM {$this->table} ORDER BY `id` DESC LIMIT 1;"
        ];
        return $q[$query];
    }

    public function last(): SolutionModel
    {
        $model = new SolutionModel();
        $sql = self::$con->prepare($this->getQuery("last"));
        $sql->execute([]);
        $res = $sql->fetch();

        if (count($res) > 0) {
            $model->setData($res);
        }
        return $model;
    }

    public function add(SolutionModel $model)
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
                $model->getDistrict(),
                $model->getCommon()
            ]);

            if ($res) {
                $this->res = self::getResponse(200, array("msg" => "New solution added", "data" => self::last()));
            } else {
                $this->res = self::getResponse(400, array("msg" => "Failed to add new solution", "data" => null));
            }

        } catch (\PDOException $e) {
            $this->res = self::getResponse(400, array("msg" => "Failed to add new solution", "data" => null));
        }
        self::display();
    }

    public function get(SolutionModel $model, string $filter)
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
                case "getByCrops" :
                {
                    $sql->execute([$model->getCrops()]);
                    break;
                }
                case "getByCategory" :
                {
                    $sql->execute([$model->getCategory()]);
                    break;
                }
                case "getByDistrict" :
                {
                    $sql->execute([$model->getDistrict()]);
                    break;
                }
                case "getByCommon" :
                {
                    $sql->execute([$model->getCommon()]);
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
            $this->res = self::getResponse(400, array("msg" => "Failed to get solution", "data" => null));
        }
        self::display();
    }


    public function handle(string $request, array $param, string $filter, string $type = "")
    {
        $model = new SolutionModel();
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