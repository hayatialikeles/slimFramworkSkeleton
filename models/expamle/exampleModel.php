<?php 
class exampleModel extends db
{
    public function getExamples($request,$response)
    {
        return $this->returnResult("deneme verisidir","deneme verisidir",$response);
        
    }
}