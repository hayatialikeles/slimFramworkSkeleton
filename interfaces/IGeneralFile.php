<?php 
interface IGeneralFile {
    public function Get($request,$response);
    public function GetSingle($request,$response);
    public function Add($request,$response,$file);
    public function Edit ($request,$response,$file);
    public function Remove($request,$response);
}