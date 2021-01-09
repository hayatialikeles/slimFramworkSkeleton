<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$app->post("/user/auth",function (Request $request,Response $response){
    $Model=new userModel();
    return $Model->userAuth($request,$response);
});
$app->post("/user/get/all",function (Request $request,Response $response){
    $Model=new userModel();
    return $Model->GetAll($request,$response);
})->add($AuthMiddleWare);

$app->post("/user/set/email",function (Request $request,Response $response){
    $Model=new userModel();
    return $Model->setEmail($request,$response);
})->add($AuthMiddleWare);

$app->post("/user/set/password",function (Request $request,Response $response){
    $Model=new userModel();
    return $Model->setPassword($request,$response);
})->add($AuthMiddleWare);


$app->post("/user/add",function (Request $request,Response $response){
    $Model=new userModel();
    return $Model->Add($request,$response);
})->add($AuthMiddleWare);
$app->post("/user/edit",function (Request $request,Response $response){
    $Model=new userModel();
    return $Model->Edit($request,$response);
})->add($AuthMiddleWare);
$app->post("/user/delete",function (Request $request,Response $response){
    $Model=new userModel();
    return $Model->Delete($request,$response);
})->add($AuthMiddleWare);


