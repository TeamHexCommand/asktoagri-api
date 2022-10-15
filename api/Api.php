<?php

namespace app\api;

use app\core\Database;

class Api implements ApiInterface
{
    private Database $db;
    protected static $con;
    private $config;
    public string $res = "";

    public function __construct(array $config)
    {
        $this->config = $config;
        $this->db = new Database($config);
        self::$con = $this->db->connect();
    }

    public function display()
    {
        header('Content-Type: application/json');
        echo $this->res;
    }

    public function getResponse(int $code, array $data): string
    {
        $res = [
            "code" => $code,
            "result" => $data
        ];

        return json_encode($res);
    }

    public function handle(string $request, array $param, string $filter, string $type = "")
    {
        switch ($type) {
            case "country":
            {
                $country = new \app\api\Countries();
                $country->handle($request, $param, $filter, $type);
                break;
            }
            case "state":
            {
                $state = new \app\api\State();
                $state->handle($request, $param, $filter, $type);
                break;
            }
            case "district":
            {
                $state = new \app\api\District();
                $state->handle($request, $param, $filter, $type);
                break;
            }
            case "city":
            {
                $state = new \app\api\City();
                $state->handle($request, $param, $filter, $type);
                break;
            }
            default:
            {
                echo "Unknown!";
            }
        }
    }
}