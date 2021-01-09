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
                return $this->getSuccess(null,$response);
            }else{
                return $this->returnResult(
                    null,
                    $addState["message"],
                    $response
                );
            }
        }else{
            return $this->getParameterError($response);
        }
    }

    public function setEmail($request,$response){
        if($request->getparam('email'))
        {

            $model=new userHelper($request->getAttribute("id"));
            $editState=$model->setEmail($request->getparam("email"));
            if($editState["state"])
            {
                return $this->getSuccess(null,$response);
            }else{
                return $this->returnResult(
                    null,
                    $editState["message"],
                    $response
                );
            }
        }else{
            return $this->getParameterError($response);
        }

    }
    public function setPassword($request,$response){
        if(
            $request->getparam('oldpassword') &&
            $request->getparam('newpassword')
        )
        {

            $model=new userHelper($request->getAttribute("id"));
            $editState=$model->setPassword(
                filter_var($request->getparam("oldpassword"),FILTER_SANITIZE_STRING),
                filter_var($request->getparam("newpassword"),FILTER_SANITIZE_STRING)
            );

            if($editState["state"])
            {
                return $this->getSuccess(null,$response);
            }else{
                return $this->returnResult(
                    null,
                    $editState["message"],
                    $response
                );
            }
        }else{
            return $this->getParameterError($response);
        }

    }
    public function Edit($request,$response){
        if(
            $request->getparam("username") && 
            $request->getparam("password") && 
            $request->getparam("phone") && 
            $request->getparam("email") 
        ){
            $model=new userHelper($request->getAttribute("id"));
            $editState=$model->edit(
                $request->getparam("username"),
                $request->getparam("password"),
                $request->getparam("email"),
                $request->getparam("phone")
            );
            if($editState["state"])
            {   
                return $this-> getSuccess(null,$response);
            }else{
                return $this->returnResult(
                    null,
                    $editState["message"],
                    $response
                );
            }

        }else{
            return $this->getParameterError($response);
        }
    }
    public function Delete($request,$response){
        $userHelper=new userHelper($request->getAttribute("id"));
        if($userHelper->delete())
        {
            $this->getSuccess(null,$response);
        }else{
            $this->getProccesFail($response);
        }
    }
}