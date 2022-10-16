<?php

namespace app\api;

use app\models\ConfigModel;

class Config extends Api implements ApiInterface
{
    public string $table = "hc_config";
    public string $exec;

    public function __construct()
    {
    }

    public function getQuery(string $query): string
    {
        $q = [
            "add" => "INSERT INTO {$this->table} (`user`,`name`,`value`) VALUES (?,?,?);",
            "getAll" => "SELECT * FROM {$this->table}",
            "getById" => "SELECT * FROM {$this->table} WHERE `id` = ?;",
            "getByName" => "SELECT * FROM {$this->table} WHERE `name` = ?;",
            "getByUser" => "SELECT * FROM {$this->table} WHERE `user` = ?;",
            "getByValue" => "SELECT * FROM {$this->table} WHERE `value` = ?;",
            "getByNameOfUser" => "SELECT * FROM {$this->table} WHERE `user` = ? and `name` = ?;",
            "getByValueOfUser" => "SELECT * FROM {$this->table} WHERE `user` = ? and `value` = ?;",
            "deleteById" => "DELETE FROM {$this->table} WHERE `id` = ?;",
            "deleteByName" => "DELETE FROM {$this->table} WHERE `name` = ?;",
            "deleteByPair" => "DELETE FROM {$this->table} WHERE `user` = ? and `name` = ? and `value` = ?;",
            "deleteByUser" => "DELETE FROM {$this->table} WHERE `user` = ?;",
            "deleteByValue" => "DELETE FROM {$this->table} WHERE `value` = ?;",
            "deleteByNameOfUser" => "DELETE FROM {$this->table} WHERE `user` = ? and `name` = ?;",
            "deleteByValueOfUser" => "DELETE FROM {$this->table} WHERE `user` = ? and `value` = ?;",
            "updateById" => "UPDATE {$this->table} SET `name` = ?, `value` = ? WHERE `id` = ?;",
            "updateByName" => "UPDATE {$this->table} SET `name` = ?, `value` = ? WHERE `name` = ?;",
            "updateByUser" => "UPDATE {$this->table} SET `name` = ?, `value` = ? WHERE `user` = ?;",
            "updateByValue" => "UPDATE {$this->table} SET `name` = ?, `value` = ? WHERE `value` = ?;",
            "updateByNameOfUser" => "UPDATE {$this->table} SET `name` = ?, `value` = ? WHERE `user` = ? and `name` = ?;",
            "updateByValueOfUser" => "UPDATE {$this->table} SET `name` = ?, `value` = ? WHERE `user` = ? and `value` = ?;",
            "last" => "SELECT * FROM {$this->table} ORDER BY `id` DESC LIMIT 1;",
            "lastUser" => "SELECT * FROM {$this->table} WHERE `user` = ? ORDER BY `id` DESC LIMIT 1;"
        ];
        return $q[$query];
    }

    public function lastUser(ConfigModel $model): ConfigModel
    {
        $model = new ConfigModel();
        $sql = self::$con->prepare($this->getQuery("lastUser"));
        $sql->execute([$model->getUser()]);
        $res = $sql->fetch();

        if (count($res) > 0) {
            $model->setData($res);
        }
        return $model;
    }

    public function getById(ConfigModel $model): ConfigModel
    {
        $model = new ConfigModel();
        $sql = self::$con->prepare($this->getQuery("getById"));
        $sql->execute([$model->getUser()]);
        $res = $sql->fetch();

        if (count($res) > 0) {
            $model->setData($res);
        }
        return $model;
    }

    public function last(): ConfigModel
    {
        $model = new ConfigModel();
        $sql = self::$con->prepare($this->getQuery("last"));
        $sql->execute([]);
        $res = $sql->fetch();

        if (count($res) > 0) {
            $model->setData($res);
        }
        return $model;
    }

    public function add(ConfigModel $model)
    {
        $sql = self::$con->prepare($this->getQuery("add"));

        try {
            $res = $sql->execute([
                $model->getUser(),
                $model->getName(),
                $model->getValue()
            ]);

            if ($res) {
                $this->res = self::getResponse(200, array("msg" => "New config added", "data" => self::last()));
            } else {
                $this->res = self::getResponse(400, array("msg" => "Failed to add new config", "data" => null));
            }

        } catch (\PDOException $e) {
            $this->res = self::getResponse(400, array("msg" => "Failed to add new config", "data" => null));
        }
        self::display();
    }

    public function get(ConfigModel $model, string $filter)
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
                case "getByName" :
                {
                    $sql->execute([$model->getName()]);
                    break;
                }
                case "getByNameOfUser" :
                {
                    $sql->execute([$model->getUser(), $model->getName()]);
                    break;
                }
                case "getByValue" :
                {
                    $sql->execute([$model->getValue()]);
                    break;
                }
                case "getByValueOfUser" :
                {
                    $sql->execute([$model->getUser(), $model->getValue()]);
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
            $this->res = self::getResponse(400, array("msg" => "Failed to get tag", "data" => null));
        }
        self::display();
    }

    public function delete(ConfigModel $model, string $filter)
    {
        $sql = self::$con->prepare($this->getQuery($filter));

        try {
            switch ($filter) {
                case "deleteById" :
                {
                    $this->exec = $sql->execute([$model->getId()]);
                    break;
                }
                case "deleteByUser" :
                {
                    $this->exec = $sql->execute([$model->getUser()]);
                    break;
                }
                case "deleteByPair" :
                {
                    $this->exec = $sql->execute([$model->getUser(), $model->getName(), $model->getValue()]);
                    break;
                }
                case "deleteByName" :
                {
                    $this->exec = $sql->execute([$model->getName()]);
                    break;
                }
                case "deleteByNameOfUser" :
                {
                    $this->exec = $sql->execute([$model->getUser(), $model->getName()],);
                    break;
                }
                case "deleteByValue" :
                {
                    $this->exec = $sql->execute([$model->getValue()]);
                    break;
                }
                case "deleteByValueOfUser" :
                {
                    $this->exec = $sql->execute([$model->getUser(), $model->getValue()]);
                    break;
                }
            }

            if ($this->exec) {
                $this->res = self::getResponse(200, array("msg" => "Record deleted", "data" => null));
            } else {
                $this->res = self::getResponse(400, array("msg" => "No records", "data" => null));
            }

        } catch (\PDOException $e) {
            $this->res = self::getResponse(400, array("msg" => "Failed to delete record", "data" => null));
        }
        self::display();
    }

    public function update(ConfigModel $model, string $filter)
    {
        $sql = self::$con->prepare($this->getQuery($filter));

        try {
            switch ($filter) {
                case "updateById" :
                {
                    $this->exec = $sql->execute([$model->getName(), $model->getValue(), $model->getId()]);
                    break;
                }
                case "updateByUser" :
                {
                    $this->exec = $sql->execute([$model->getName(), $model->getValue(), $model->getUser()]);
                    break;
                }
                case "updateByName" :
                {
                    $this->exec = $sql->execute([$model->getName(), $model->getValue(), $model->getName()]);
                    break;
                }
                case "updateByNameOfUser" :
                {
                    $this->exec = $sql->execute([$model->getName(), $model->getValue(), $model->getName(), $model->getName()]);
                    break;
                }
                case "updateByValue" :
                {
                    $this->exec = $sql->execute([$model->getName(), $model->getValue(), $model->getValue()]);
                    break;
                }
                case "updateByValueOfUser" :
                {
                    $this->exec = $sql->execute([$model->getName(), $model->getValue(), $model->getName(), $model->getValue()]);
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
        $model = new ConfigModel();
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
            case "delete":
            {
                self::delete($model, $filter);
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