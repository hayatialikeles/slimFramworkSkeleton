<?php 
class errorShorten extends general
{
    private $proccesSucces="procces completed successfully";
    private $proccesFail="operation failed, please try again later.";
    private $parameterError="required values ​​could not be transmitted to remote server , please try again later. !";

    public function getSuccess($data=null,$response)
    {
        return $this->returnResult(
            $data,
            $this->proccesSucces,
            $response,
            true
        );
    }

    public function getProccesFail($response)
    {
        return $this->returnResult(
            null,
            $this->proccesFail,
            $response,
            false,
            502
        );
    }

    public function getParameterError($response)
    {
       return  $this->returnResult(
            null,
            $this->parameterError,
            $response,
            false,
            503
        );
    }
}