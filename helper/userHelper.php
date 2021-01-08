<?php
use \Firebase\JWT\jwt;
date_default_timezone_set('Europe/Istanbul');

// admin users db helper
class userHelper extends db {
    private $username='';
    private $password='';
    private $email='';
    private $phone='';

    private $userId="";

    public function checkTable(){
        if(empty($this->queryNameString("SELECT count(id) FROM users"))){
            $this->executeQuery("
            CREATE TABLE `users` (
                `id` int(11) NOT NULL,
                `username` varchar(20) COLLATE utf8_turkish_ci NOT NULL,
                `password` varchar(256) COLLATE utf8_turkish_ci NOT NULL,
                `email` varchar(256) COLLATE utf8_turkish_ci NOT NULL,
                `phone` varchar(15) COLLATE utf8_turkish_ci,
                `addDate` varchar(20) COLLATE utf8_turkish_ci NOT NULL,
                `addId` int(11) COLLATE utf8_turkish_ci NOT NULL
              ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

              ALTER TABLE `users`
                ADD PRIMARY KEY (`id`);

              ALTER TABLE `users`
                MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
              COMMIT;
            ",array());
        }
    }
    public function __construct($userId="0"){
        $this->checkTable();
        
        $this->userId=$userId;
        if($this->userId>0)
        {
            $userData=$this->getUserDetail();
            $this->username=$userData["username"];
            $this->email=$userData["email"];
            $this->phone=$userData["phone"];
        }
    }
    public function authControl($username,$password){

        if($this->checkUsername($username))
        {
            $userData=$this->getSingleCell("SELECT * FROM users where username=? and `password`=?",array(
                $username, 
                $this->passwordHash($password)
            ));
            if($userData["id"]>0)
            {
                $key = "65EC4£>B£AFA6?=(14CF745CC9BA8*09%!'A78A4A"; // bu bizim oluşturacağımız bi nevi şifremiz
                
                $iss = "http://localhost:80";
                $aud = "http://localhost:80";
                $iat = 1356999524;
                $nbf = 1357000000;
            
                $token = [
                    'iss' => "http://localhost:80",
                    'aud' => "http://localhost:80",
                    'iat' => 1356999524,
                    'nbf' => 1357000000,
                    'data' =>array(
                        "id"=>$userData["id"],
                        "username"=>$userData["username"],
                        "email"=>$userData["password"],
                    )
                ];

                $jwt = JWT::encode($token,$key);


                return array(
                    "state"=>true,
                    "data"=>$jwt
                );
            }else{
                return array(
                    "state"=>false,
                    "message"=>"username and password incorrect !"
                );    
            }
        }else{
            return array(
                "state"=>false,
                "message"=>"username not found !"
            );
        }
    }
    public function add($username,$password,$email,$phone,$userId){
        if(!$this->checkUsername($username))
        {
            if(!$this->checkEmail($email))
            {
                echo $this->executeQuery("INSERT INTO users SET username=?,`password`=?,email=?,phone=?,addDate=now(),addId=?",
                array(
                    $username,
                    $this->passwordHash($password),
                    $email,
                    $phone,
                    $userId
                ));
                return array(
                    "state"=>true,
                );
            }else{
                return array(
                    "state"=>false,
                    "message"=>"email is used by another user"
                );
            }
        }else{
            return array(
                "state"=>false,
                "message"=>"username is used by another user"
            );
        }

    }
    public function checkUsername($username){
        return $this->queryNameParameterString("SELECT * FROM users where username=?",$username) ? true :false;
    }
    public function checkEmail($email){
        return $this->queryNameParameterString("SELECT * FROM users where username=?",$email) ? true :false;
    }
    public function getUserDetail(){
        return $this->getSingleCell("SELECT * FROM users where id=?",array($this->userId));
    }
    public function getEmail(){
        return $this->email;
    }
    public function getUsername(){
        return $this->username;
    }
    public function getPhoneNumber(){
        return $this->phone;
    }
    public function getList(){
        return $this->getTable("SELECT id,username,email,phone,addDate FROM users");
    }
}