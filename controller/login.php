<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;


// example method

$app->get("/example",function (Request $request,Response $response){
    $exampleModel=new exampleModel();
    return $exampleModel->getExamples($request,$response);
    
});