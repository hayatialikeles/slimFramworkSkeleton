<?php
interface IGeneral 
{
    public function GetAll($request,$response);
    public function GetSingle($request,$response);
    public function Add($request,$response);
    public function Edit($request,$response);
    public function Remove($request,$response);
}