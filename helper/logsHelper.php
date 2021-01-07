<?php
class logsModel extends db {
    private $userId="";
    private $explanation="";

    private function checkTable(){
        if(empty($this->queryNameString("SELECT count(id) FROM images")))
        {
            $this->executeQuery("
            CREATE TABLE `logs` (
                `id` int(11) NOT NULL,
                `explanation` text COLLATE utf8_turkish_ci NOT NULL,
                `userId` int(11) NOT NULL,
                `createDate` varchar(20) COLLATE utf8_turkish_ci NOT NULL
              ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

              ALTER TABLE `images`
                ADD PRIMARY KEY (`id`);

              ALTER TABLE `images`
                MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
              COMMIT;
            ",array());
        }
    }
    public function __construct($explanation,$userId){
        if(!empty($explanation) && $userId>0)
        {

            $this->userId=$userId;
            $this->explanation = $explanation;
            $this->checkTable();
            return array(
                "state"=>true
            );
        }else{
            return array(
                "state"=>false,
                "message"=>"userId and password is required !"
            );
        }

    }
    public function save(){
        $this->executeQuery("INSERT INTO `logs` SET `userId`=?, `Route`=?, `addDate`=now()",array(
            $this->userId,
            $this->explanation
        ));
    }
}
