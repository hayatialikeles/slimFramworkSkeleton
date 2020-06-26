<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

require 'vendor/autoload.php';
$app =new \Slim\App();

require_once './class/general.php';
require_once './class/db.php';
require_once './models/expamle/exampleModel.php';
require  'controller/login.php';

$app->run();

?>
