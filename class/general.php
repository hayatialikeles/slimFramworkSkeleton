<?php 
class general 
{
    public function returnResult($result,$message,$response,$state=false,$statusCode=200){
        return $response
            ->withStatus($statusCode)
            ->withHeader("Content-type","application/json")
            ->withJson(
                array(
                    "state"=>$state,
                    "message"=>$message,
                    "data"=>$result
                ));
        }
    
    
    public function GenerateToken($Lenght=256){
        return bin2hex(openssl_random_pseudo_bytes($Lenght));
        }
}
