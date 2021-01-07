<?php

interface ModelView
{
    public function getAll($response);
    public function Add($request,$response);
    public function Edit($request,$response);
    public function delete($request,$response);
}

interface ModelFileView{
    public function getAll($response);
    public function Add($request,$response,$files);
    public function Edit($request,$response,$files);
    public function delete($request,$response);
}