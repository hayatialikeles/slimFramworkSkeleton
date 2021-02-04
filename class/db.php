<?php
class db extends errorShorten
{
    private $host="192.168.1.7";
    private $dbName="marmarasondaj";
    private $username="root";
    private $password="mypass123";
    private $dbh=null;

    public function __construct(){
        $this->connection();
    }

    private function connection()
    {
        try 
        {
            $this->dbh = new PDO('mysql:host='.$this->host.';dbname='.$this->dbName.';charset=utf8', $this->username,$this->password,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
        } catch (PDOException $e) 
        {
            print "Hata!: " . $e->getMessage() . "<br/>";
            return null;
        }
    }

    public function executeQuery($sql,$parameters_array=array()){
        try{
            if($this->dbh==null)
            {
                $this->connection();
            }
            $get_row = $this->dbh->prepare($sql);
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
    
	public function getSingleCell($sql,$parameter=null){
        try{
            if($this->dbh==null)
            {
                $this->connection();
            }
            $get_row = $this->dbh->prepare($sql);
            if($parameter!=null)
                $get_row->execute(array($parameter));
            else
                $get_row->execute();

            $row = $get_row->fetch();
            return $row[0];

        }catch (PDOException $e)
        {
            print_r($e->getMessage());
            return null;
        }
     }
    public function getTable($sql,$paramters=array()){
        try{
            if($this->dbh==null)
            {
                $this->connection();
            }
            $statement = $this->dbh->prepare($sql);
            $statement->execute($paramters);
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }catch (PDOException $e)
        {
            print_r($e->getMessage());
            return null;
        }
     }
    public function getSingleRow($sql,$paramters=array()){
        try{
            if($this->dbh==null)
            {
                $this->connection();
            }
            $statement = $this->dbh->prepare($sql);
            $statement->execute($paramters);
            return $statement->fetch(PDO::FETCH_ASSOC);

        }catch (PDOException $e)
        {
            print_r($e->getMessage());
            return null;
        }
     }
}
