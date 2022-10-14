<?php

require_once __DIR__ . '/../vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

use app\core\Application;
use app\models\TagsModel;

$config = [
    'db' => [
        'dsn' => $_ENV['DB_DSN'],
        'user' => $_ENV['DB_USER'],
        'password' => $_ENV['DB_PASSWORD']
    ]
];

//$tags = new TagsModel();
//$tags->setName("new");
//
//$db = new \app\core\Database($config['db']);
//$con = $db->connect();
//$query = "INSERT INTO `hc_tags`(`name`) VALUES (?)";
//$sql = $con->prepare($query);
//$res = $sql->execute([$tags->getName()]);

//$app = new Application(dirname(__DIR__), $config);

//$app->router->get('/', function () {
//    return 'Hello world';
//});

//$app->run();
?>