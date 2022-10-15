<?php

require_once __DIR__ . '/../vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

use app\core\Application;

$config = [
    'db' => [
        'dsn' => $_ENV['DB_DSN'],
        'user' => $_ENV['DB_USER'],
        'password' => $_ENV['DB_PASSWORD']
    ]
];

$req = file_get_contents("php://input");

if ($req != null) {
    $data = json_decode($req, true);
    if (isset($data['request']) && isset($data['type']) && isset($data['param']) && isset($data['filter'])) {
        $api = new \app\api\Api($config['db']);
        $api->handle($data['request'], $data['param'], $data['filter'], $data['type']);
    } else {
        echo "Unknown!";
    }
}

//$app = new Application(dirname(__DIR__), $config);

//$app->router->get('/', function () {
//    return 'Hello world';
//});

//$app->run();
?>