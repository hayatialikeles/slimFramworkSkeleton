<?php
class db extends general
{
    private $username="root";
    private $password="";
    private $dbName="";
    private $host="localhost";

    public function connection(){
        
        try {
            $dbh = new PDO('mysql:host='.$this->host.';dbname='.$this->dbName.';charset=utf8', $this->username,$this->password,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
            return $dbh;
        } catch (PDOException $e) {
            print "Hata!: " . $e->getMessage() . "<br/>";
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
    public function getSingleCell($sql,$paramters){
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
    
    
}
