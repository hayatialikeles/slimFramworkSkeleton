<?php 
class UserModel extends db
{
    public function GetAll($request,$response){
        $userHelper=new userHelper();
        return $this->returnResult(
            $userHelper->getList(),
            "İŞLEM BAŞARILI",
            $response,
            true
        );
    }   
    public function userAuth($request,$response){
        $userHelper=new userHelper();
        $authState=$userHelper->authControl(
            filter_var($request->getparam("username"),FILTER_SANITIZE_STRING),
            filter_var($request->getparam("password"),FILTER_SANITIZE_STRING)
        );

        if($authState["state"])
        {
            return $this->returnResult(
                $authState["data"],
                "İŞLEM BAŞARILI !",
                $response,
                true
            );
        }else{
            return $this->returnResult(
                null,
                $authState["message"],
                $response
            );
        }
    }

    public function Add($request,$response){
        if(
            $request->getparam("username") &&
            $request->getparam("password") &&
            $request->getparam("email") &&
            $request->getparam("phone")
        )
        {

            $userHelper=new userHelper();
            $addState=$userHelper->add(
                $request->getparam("username"),
                $request->getparam("password"),
                $request->getparam("email"),
                $request->getparam("phone"),
                $request->getAttribute("id")
            );

            if($addState["state"])
            {
                return $this->returnResult(
                    null,
                    "İŞLEM BAŞARILI",
                    $response,
                    true
                );

            }else{
                return $this->returnResult(
                    null,
                    $addState["message"],
                    $response
                );
            }
        }else{

        }


    }
    public function Edit($request,$response){
        
    }
    public function Remove($request,$response){
    }
}