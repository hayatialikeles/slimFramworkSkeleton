<?php 
class UserModel extends db implements IGeneral
{
    public function GetAll($request,$response){
        return $this->returnResult(
            null,
            "İŞLEM BAŞARILI",
            $response,
            true
        );
    }   

    public function GetSingle($request,$response){

    }

    public function Add($request,$response){
        
    }

    public function Edit($request,$response){

    }

    public function Remove($request,$response){

    }
}