<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

require 'vendor/autoload.php';
$app =new \Slim\App(array(
    'debug' => true
));




// Interfaces
require_once './interfaces/IGeneral.php';
require_once './interfaces/IGeneralFile.php';

// Class
require_once './class/general.php';
require_once './class/db.php';

// helpers
require_once './helper/ImageHelper.php';
require_once './helper/settingsHelper.php';
require_once './helper/userHelper.php';

// MiddleWare
require_once './middleWare/authMiddle.php';

// Models
require_once './models/userModel.php';




// Controller
require_once  'controller/userController.php';

$app->run();

?>
