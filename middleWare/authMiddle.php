<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use \Firebase\JWT\jwt;
date_default_timezone_set('Europe/Istanbul');

$app->options('/{routes:.+}', function ($request, $response, $args) {
    return $response;
});

$app->add(function ($req, $res, $next) {
    $response = $next($req, $res);
    return $response
            ->withHeader('Access-Control-Allow-Origin', '*')
            ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH, OPTIONS');
});

// auth middle ware 
$AuthMiddleWare=function ($request, $response, $next) {
    $model=new db();
    if($request->getparam('token'))
    {
        try {
            $token=$request->getparam('token');
            $decoded = JWT::decode($token, "65EC4£>B£AFA6?=(14CF745CC9BA8*09%!'A78A4A", array('HS256'));
            $request = $request->withAttribute('id', $decoded->data->id);
            return $next($request,$response);
        }
        catch (Exception $e) {
            return $model->returnResult(
                null,
                $e->getMessage(),
                $response
            );
        }
       
    }else{
        return $model->returnResult(
            null,
            "KULLANICI GÜVENLİK KODUNUZ UZAK SUNUCUYA İLETİLEMEDİ !",
            $response
        );
    }
	return $response;
};