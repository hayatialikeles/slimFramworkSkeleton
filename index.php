<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

require 'vendor/autoload.php';
$app =new \Slim\App();

require 'class/dbconnection.php';
require  'controller/login.php';

$app->run();

?>
