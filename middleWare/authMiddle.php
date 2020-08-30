<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

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
    
    if($request->getparam('uid') && $request->getparam('token'))
    {
        $userId=filter_var($request->getparam('uid'),FILTER_SANITIZE_NUMBER_INT);
        $token=filter_var($request->getparam('token'),FILTER_SANITIZE_STRING);

        // user control
       
    }else{
        return $Model->returnResult(
            null,
            "KULLANICI BİLGİLERİ UZAK SUNUCUYA İLETİLEMEDİ !",
            $response
        );
    }
	return $response;
};