<?php

namespace app\api;

use app\models\UserModel;

class User extends Api implements ApiInterface
{
    public string $table = "hc_user";

    public function __construct()
    {
    }

    public function getQuery(string $query): string
    {
        $q = [
            "add" => "INSERT INTO {$this->table} (`mobile`,`firebaseId`,`defaultFcm`,`latitude`,`longitude`,`ip`, `city`) VALUES (?, ?, ?, ?, ?, ?, ?);",
            "getAll" => "SELECT * FROM {$this->table}",
            "getById" => "SELECT * FROM {$this->table} WHERE `id` = ?;",
            "getByMobile" => "SELECT * FROM {$this->table} WHERE `mobile` = ?;",
            "getByFirebaseId" => "SELECT * FROM {$this->table} WHERE `firebaseId` = ?;",
            "getByEmail" => "SELECT * FROM {$this->table} WHERE `email` = ?;",
            "last" => "SELECT * FROM {$this->table} ORDER BY `id` DESC LIMIT 1;"
        ];
        return $q[$query];
    }

    public function last(): UserModel
    {
        $model = new UserModel();
        $sql = self::$con->prepare($this->getQuery("last"));
        $sql->execute([]);
        $res = $sql->fetch();

        if (count($res) > 0) {
            $model->setData($res);
        }
        return $model;
    }

    public function add(UserModel $model)
    {
        $sql = self::$con->prepare($this->getQuery("add"));

        try {
            $res = $sql->execute([
                $model->getMobile(),
                $model->getFirebaseId(),
                $model->getDefaultFcm(),
                $model->getLatitude(),
                $model->getLongitude(),
                self::getVisIpAddr(),
                self::getLocation(self::getVisIpAddr())->city
            ]);

            if ($res) {
                $this->res = self::getResponse(200, array("msg" => "New user added", "data" => self::last()));
            } else {
                $this->res = self::getResponse(400, array("msg" => "Failed to add new user", "data" => null));
            }
        } catch (\PDOException $e) {
            $this->res = self::getResponse(400, array("msg" => "Failed to add new user", "data" => null));
        }
        self::display();
    }

    public function get(UserModel $model, string $filter)
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
                case "getByMobile" :
                {
                    $sql->execute([$model->getMobile()]);
                    break;
                }
                case "getByEmail" :
                {
                    $sql->execute([$model->getEmail()]);
                    break;
                }
                case "getByFirebaseId" :
                {
                    $sql->execute([$model->getFirebaseId()]);
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
            $this->res = self::getResponse(400, array("msg" => "Failed to get user", "data" => null));
        }
        self::display();
    }


    public function handle(string $request, array $param, string $filter, string $type = "")
    {
        $model = new UserModel();
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