<?php

namespace app\api;

use app\models\UploadModel;

class Upload extends Api implements ApiInterface
{
    public string $table = "hc_upload";

    public function __construct()
    {
    }

    public function generateGuid(): string
    {
        if (function_exists('com_create_guid')) {
            return com_create_guid();
        } else {
            mt_srand((double)microtime() * 10000); //optional for php 4.2.0 and up.
            $charid = strtoupper(md5(uniqid(rand(), true)));
            $hyphen = chr(45);
            $uuid = substr($charid, 0, 8) . $hyphen
                . substr($charid, 8, 4) . $hyphen
                . substr($charid, 12, 4) . $hyphen
                . substr($charid, 16, 4) . $hyphen
                . substr($charid, 20, 12);
            return $uuid;
        }
    }

    public function saveFile(UploadModel $model)
    {
        $name = self::generateGuid();
        $ext = "jpg";

        $type = explode(";base64,", $model->getBase64());

        if ($type[0] === "data:audio/mpeg" || $type[0] === "audio/x-matroska" || $type[0] === "audio/mp3") {
            $ext = "mp3";
        } elseif ($type[0] === "audio/ogg") {
            $ext = "ogg";
        } elseif ($type[0] === "data:video/mpeg" || $type[0] === "data:video/mp4") {
            $ext = "mp4";
        } elseif ($type[0] === "video/x-matroska") {
            $ext = "mkv";
        }elseif ($type[0] === "video/x-msvideo" ) {
            $ext = "avi";
        } elseif ($type[0] === "data:image/png") {
            $ext = "png";
        } elseif ($type[0] === "data:image/jpeg" || type[0] === "data:image/jpg") {
            $ext = "png";
        } else {
            return null;
            exit;
        }

        $file = str_replace('data:video/mpeg;base64,', '', $model->getBase64());
        $file = str_replace('data:image/jpeg;base64,', '', $file);
        $file = str_replace('data:audio/mpeg;base64,', '', $file);
        $file = str_replace('data:image/png;base64,', '', $file);
        $file = str_replace(' ', '+', $file);

        $data = base64_decode($file);

        $file = $_SERVER['DOCUMENT_ROOT'] . '/uploads/' . $name . '.' . $ext;
        // $file = dirname(__FILE__) . '/uploads/' . $name . '.' . $ext;
        // Save Image in the Image Directory
        $success = file_put_contents($file, $data);

        $model->setName($name);
        $model->setType($ext);

        // echo $file;

        return $model;
    }

    public function getQuery(string $query): string
    {
        $q = [
            "add" => "INSERT INTO {$this->table} (`user`, `name`,`type`) VALUES (?, ?, ?);",
            "getAll" => "SELECT * FROM {$this->table}",
            "getById" => "SELECT * FROM {$this->table} WHERE `id` = ?;",
            "last" => "SELECT * FROM {$this->table} ORDER BY `id` DESC LIMIT 1;"
        ];
        return $q[$query];
    }

    public function last(): UploadModel
    {
        $model = new UploadModel();
        $sql = self::$con->prepare($this->getQuery("last"));
        $sql->execute([]);
        $res = $sql->fetch();

        if (count($res) > 0) {
            $model->setData($res);
        }
        return $model;
    }

    public function add(UploadModel $model)
    {
        $sql = self::$con->prepare($this->getQuery("add"));

        $m = self::saveFile($model);

        if ($m != null) {
            try {
                $res = $sql->execute([
                    $model->getUser(),
                    $m->getName(),
                    $m->getType()
                ]);

                if ($res) {
                    $this->res = self::getResponse(200, array("msg" => "New file added", "data" => self::last()));
                } else {
                    $this->res = self::getResponse(400, array("msg" => "Failed to add new file", "data" => null));
                }

            } catch (\PDOException $e) {
                $this->res = self::getResponse(400, array("msg" => "Failed to add new file", "data" => null));
            }
        } else {
            $this->res = self::getResponse(400, array("msg" => "Invalid file", "data" => null));
        }


        self::display();
    }

    public function get(UploadModel $model, string $filter)
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
            }

            $res = $sql->fetchAll();

            if ($res && count($res) > 0) {
                $this->res = self::getResponse(200, array("msg" => "Record found", "data" => $res));
            } else {
                $this->res = self::getResponse(400, array("msg" => "No records", "data" => null));
            }

        } catch (\PDOException $e) {
            $this->res = self::getResponse(400, array("msg" => "Failed to get file", "data" => null));
        }
        self::display();
    }


    public function handle(string $request, array $param, string $filter, string $type = "")
    {
        $model = new UploadModel();
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