<?php

namespace app\core;
/**
 * Class Application
 *
 * @auther  Yash Gohel <yashgohel16@gmail.com>
 * @package app\core
 */
class Application
{

    private static string $ROOT_DIR;
    public Router $router;
    public Request $request;
    public Response $response;
    public Application $app;
    public Database $db;

    public function __construct($rootPath, array $config)
    {
        $this->app = $this;
        self::$ROOT_DIR = $rootPath;
        $this->request = new Request();
        $this->response = new Response();
        $this->router = new Router($this->request, $this->response);

        $this->db = new Database($config['db']);
    }

    public function run()
    {
        $this->router->resolve();
    }
}