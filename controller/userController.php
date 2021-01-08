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


$app->post("/user/get/single",function (Request $request,Response $response){
    $Model=new userModel();
    return $Model->GetAll($request,$response);
})->add($AuthMiddleWare);

$app->post("/user/add",function (Request $request,Response $response){
    $Model=new userModel();
    return $Model->Add($request,$response);
})->add($AuthMiddleWare);

$app->post("/user/edit",function (Request $request,Response $response){
    $Model=new userModel();
    return $Model->Edit($request,$response);
});

