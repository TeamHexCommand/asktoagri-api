<?php

namespace app\api;

use app\models\ArticalModel;

class Artical extends Api implements ApiInterface
{
    public string $table = "hc_artical";

    public function __construct()
    {
    }

    public function getQuery(string $query): string
    {
        $q = [
            "add" => "INSERT INTO {$this->table} (`user`,`title`,`category`,`tags`,`body`) VALUES (?, ?, ?, ?, ?);",
            "getAll" => "SELECT * FROM {$this->table}",
            "getById" => "SELECT * FROM {$this->table} WHERE `id` = ?;",
            "getByUser" => "SELECT * FROM {$this->table} WHERE `user` = ?;",
            "getByTags" => "SELECT * FROM {$this->table} WHERE `tags` LIKE ?",
            "getByCategory" => "SELECT * FROM {$this->table} WHERE `category` = ?;",
            "getByTrending" => "SELECT * FROM {$this->table} ORDER BY `id` DESC LIMIT 20;",
            "last" => "SELECT * FROM {$this->table} ORDER BY `id` DESC LIMIT 1;"
        ];
        return $q[$query];
    }

    public function last(): ArticalModel
    {
        $model = new ArticalModel();
        $sql = self::$con->prepare($this->getQuery("last"));
        $sql->execute([]);
        $res = $sql->fetch();

        if (count($res) > 0) {
            $model->setData($res);
        }
        return $model;
    }

    public function add(ArticalModel $model)
    {
        $sql = self::$con->prepare($this->getQuery("add"));

        try {
            $res = $sql->execute([
                $model->getUser(),
                $model->getTitle(),
                $model->getCategory(),
                $model->getTags(),
                $model->getBody()
            ]);

            if ($res) {
                $this->res = self::getResponse(200, array("msg" => "New artical added", "data" => self::last()));
            } else {
                $this->res = self::getResponse(400, array("msg" => "Failed to add new artical", "data" => null));
            }

        } catch (\PDOException $e) {
            $this->res = self::getResponse(400, array("msg" => "Failed to add new artical", "data" => null));
        }
        self::display();
    }

    public function get(ArticalModel $model, string $filter)
    {
        $sql = self::$con->prepare($this->getQuery($filter));

        try {
            switch ($filter) {
                case "getByTrending":
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
                case "getByCategory" :
                {
                    $sql->execute([$model->getCategory()]);
                    break;
                }
                case "getByTags" :
                {
                    $sql->execute([$model->getTags()]);
                    break;
                }
                case "getByUser" :
                {
                    $sql->execute([$model->getUser()]);
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
            $this->res = self::getResponse(400, array("msg" => "Failed to get artical", "data" => null));
        }
        self::display();
    }


    public function handle(string $request, array $param, string $filter, string $type = "")
    {
        $model = new ArticalModel();
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