<?php
require 'vendor/autoload.php';
class_alias('\RedBeanPHP\R', '\R');

R::setup('mysql:host=localhost;dbname=auth','root', 'root');
if(!R::testConnection()) die('No DB connection!');

$configuration = [
    'settings' => [
        'displayErrorDetails' => true
    ]
];

$c = new \Slim\Container($configuration);
$app = new \Slim\App($c);

$routeFiles = (array) glob('routes/*.php');
foreach($routeFiles as $routeFile) {
    require_once $routeFile;
}

$app->run();

/*
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `is_admin` tinyint(1) unsigned NOT NULL,
  `nick` text NOT NULL,
  `password` text NOT NULL,
  `email` text NOT NULL,
  `login_key` text,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
*/
?>
