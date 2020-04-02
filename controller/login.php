<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

define("ParameterError",
    array(
        "state"=>false,
        "message"=>"Gerekli değerler uzak sunucuya iletilmedi !",
    ));

define("ParameterTypeError",
    array(
        "state"=>false,
        "message"=>"Bişeyler ters gitti tekrar deneyin !",

    )
);
define("ProcessFail",
    array(
        "state"=>false,
        "message"=>"İşlem başarısız oldu lütfen daha sonra tekrar deneyiniz !"
        
        )
);
define("UserError",
    array(
        "state"=>false,
        "message"=>"Hatalı kullanıcı Kimliği"
        )
);
define("TokenError",
array(
        "state"=>false,
        "message"=>"Hesabınıza farklı bir cihazdan bağlantı gerçekleştirildiği için tekrar giriş yapmanız gerekmektedir !"
    )
);



// login control,
$app->post("/hello-world",function (Request $request,Response $response){
            return $response
            ->withStatus(201)
            ->withHeader("Content-type","application/json")
            ->withJson(
                array(
                    'state'=>true,
                    'message'=>'MERHABA DÜNYA'
                )
            );
        
});