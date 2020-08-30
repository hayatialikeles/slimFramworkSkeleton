<?php 
class general 
{
    public function returnResult($result,$message,$response,$state=false,$statusCode=200){
        return $response
            ->withStatus($statusCode)
            ->withHeader("Content-type","application/json")
            ->withJson(
                array(
                    "state"=>$state,
                    "message"=>$message,
                    $result!=null && "data"=>$result 
                ));
        }
    
    
    public function GenerateToken($Lenght=256){
        return bin2hex(openssl_random_pseudo_bytes($Lenght));
     }
    public function uploadFile($Image,$baseUrl="assets/",$fileType=["jpg","jpeg","png"],$fileSize=500000){
        $target_dir = $baseUrl;
        $target_file = $target_dir .$this->GenerateToken(30).basename($Image["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        $state="";

        // Check file size
        if ($Image["size"] > $fileSize) {
            $state="Resim boyutu çok yüksek !";
            $uploadOk = 0;
        }

        // Allow certain file formats
        if(!in_array($imageFileType,$fileType))
        {
            $state="Lütfen doğru formatta dosya seçiniz !";
            $uploadOk = 0;
        }

        if ($uploadOk == 0) {
            return array(
                "state"=>false,
                "message"=>$state,
            );
        } 
        else {
            if (move_uploaded_file($Image["tmp_name"], $target_file)) {
                return array(
                    "state"=>true,
                    "data"=>$target_file
                );
            } else {
                return array(
                    "state"=>false,
                    "message"=>"İşlem başarısız oldu"
                );
            }
        }
     }

}
