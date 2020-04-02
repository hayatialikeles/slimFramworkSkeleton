<?php
class dbconnection
{
	
    public function connection(){
        try {
            $dbh = new PDO('mysql:host=localhost;dbname=ecommerce;charset=utf8', "root","",array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
            return $dbh;
        } catch (PDOException $e) {
            print "Hata!: " . $e->getMessage() . "<br/>";
            return null;
        }
    }
    public function loginController($email,$password){
        try{
            $query=$this->connection()->prepare("select id from users where email=? and password=?");
            $query->execute(array($email,$password));
            $row = $query->fetch();
            if ($row[0]>0)
            {
                return $row[0];
            }else{
                return 0;
            }


        }catch (PDOException $e)
        {
            print $e->getMessage();
            return 0;
        }
    }
    public function setToken($user_id){
        try {
            return $this->executeQuery("update users set Token=? where id=?",array($this->GenerateToken(),$user_id));

        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }
    public function getToken($user_id){
        try {
            return $this->queryNameParameterString("select token from  users  where id=?",$user_id);

        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }
    public function query_name_string($sql){
        try{
            $get_row = $this->connection()->prepare($sql);
            $get_row->execute();
            $row = $get_row->fetch();
            return $row[0];
        }catch (PDOException $e)
        {
            print_r($e->getMessage());
            return null;
        }
    }
    public function executeQuery($sql,$parameters_array){
        try{
            $get_row = $this->connection()->prepare($sql);
            if ($get_row->execute($parameters_array)){
                return 1;
            }
            else{
                return 0;
            }
        }catch (PDOException $e)
        {
            print_r($e->getMessage());
            return null;
        }
    }
	public function queryNameParameterString($sql,$parameter){
        try{
            $get_row = $this->connection()->prepare($sql);
            $get_row->execute(array($parameter));
            $row = $get_row->fetch();
            return $row[0];
        }catch (PDOException $e)
        {
            print_r($e->getMessage());
            return null;
        }
    }
    public function getTable($sql,$paramters){
        try{
            $statement = $this->connection()->prepare($sql);
            $statement->execute($paramters);
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }catch (PDOException $e)
        {
            print_r($e->getMessage());
            return null;
        }
    }
    public function getSingleTable($sql,$paramters){
        try{

            $statement = $this->connection()->prepare($sql);
            $statement->execute($paramters);
            return $statement->fetch(PDO::FETCH_ASSOC);

        }catch (PDOException $e)
        {
            print_r($e->getMessage());
            return null;
        }
    }
    function GenerateToken($Lenght=256)
    {
        return bin2hex(openssl_random_pseudo_bytes($Lenght));
    }
}
