<?php 
class ImageModel extends db {
    private $image=null;
    private $imageId=0;
    private $userId=0;
    private $road='assets/images/';
    private $fileType=["png","jpg","jpeg","gif"];

    private function checkTable(){
        if(empty($this->queryNameString("SELECT count(id) FROM images")))
        {
            $this->executeQuery("
            CREATE TABLE `images` (
                `id` int(11) NOT NULL,
                `imageUrl` text COLLATE utf8_turkish_ci NOT NULL,
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
    public function __construct($image,$userId){
        if(!empty($image["name"])){
            $this->image=$image;
            $this->userId=$userId;
            $this->checkTable();
            return array(
                "state"=>200
            );
        }else{
            return array(
                "message"=>"file not found ",
                "state"=>404
            );
        }
    }
    public function setImage($image){
        $this->image=$image;
    }
    public function setImageId($id){
        $this->imageId=$id;
    }
    public function setRoad($road){
        $this->road=$road;
    }
    public function setTypeList($typeList=[]){
        $this->fileType=$typeList;
    }
    public function addFileType($type){
        array_push($this->fileType,$type);
    }

    public function getFileRoad(){
        return $this->queryNameParameterString("SELECT imageUrl from images where id=?",$this->imageId);
    }
    public function saveImage(){
            $upload=$this->uploadFile(
                $this->image,
                $this->road,
                $this->fileType
            );

            if($upload["state"]==true)
            {
                $this->executeQuery("INSERT INTO `images` set `imageUrl`=?,userId=?,createDate=now()",
                array(
                    $upload["data"],
                    $this->userId
                ));
                return array(
                    "state"=>true,
                    "data"=>$this->query_name_string("SELECT max(id) FROM images")
                );
            }else{
                return array(
                    "state"=>false,
                    "message"=>$upload["message"]
                );
            } 
    }
    public function editImage(){
            $this->deleteFile($this->getFileRoad());

            $upload=$this->uploadFile(
                $this->image,
                $this->road,
                $this->fileType
            );

            if($upload["state"]==true)
            {
                $this->executeQuery("UPDATE `images` set `imageUrl`=?,userId=?,createDate=now() WHERE id=?",
                array(
                    $upload["data"],
                    $this->userId,
                    $this->imageId
                ));

                return array(
                    "state"=>true,
                    "message"=>"file upload proccess successfull"
                );
            }else{
                return array(
                    "state"=>false,
                    "data"=>$upload["message"]
                );
            }
    }
    public function deleteImage(){
        $fileRoad=$this->getFileRoad();
        $this->deleteFile($this->getFileRoad());
        $this->executeQuery("DELETE FROM images where id=?",array($this->imageId));
    }
}