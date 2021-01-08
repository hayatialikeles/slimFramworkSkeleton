<?php
class settingsHelper extends db {
    public $explanation="";
    public $logoId="";
    public $logoUrl="";

    public $facebookUrl="";
    public $instagramUrl="";
    public $twitterUrl="";
    public $linkedinUrl="";
    public $youtubeUrl="";

    private function checkTable(){
        if(empty($this->getSingleCell("SELECT count(id) FROM settings")))
        {
            $this->executeQuery("CREATE TABLE `settings` (
                `id` int(11) NOT NULL,
                `explanation` text COLLATE utf8_turkish_ci,
                `facebookUrl` text COLLATE utf8_turkish_ci,
                `InstagramUrl` text COLLATE utf8_turkish_ci,
                `twitterUrl` text COLLATE utf8_turkish_ci,
                `linkedinUrl` text COLLATE utf8_turkish_ci,
                `youtubeUrl` text COLLATE utf8_turkish_ci,
                `logoId` int(11),
              ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;
              ALTER TABLE `settings`
              ADD PRIMARY KEY (`id`);
              ALTER TABLE `settings`
                MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
              COMMIT;
            ",array());

            $this->executeQuery("INSERT INTO settings SET id=1");
        }
    }
    public function __construct(){
        $this->checkTable();
        $detail=$this->getSingleRow("SELECT * FROM settings where id=1");

        $this->explanation=$detail["explanation"];
        $this->logoId=$detail["logoId"];
        $imageModel=new ImageModel(null,null);
        $this->logoUrl= $imageModel->setImageId($this->logoId);
        $this->facebookUrl=$detail["facebookUrl"];
        $this->InstagramUrl=$detail["InstagramUrl"];
        $this->twitterUrl=$detail["twitterUrl"];
        $this->linkedinUrl=$detail["linkedinUrl"];
        $this->youtubeUrl=$detail["youtubeUrl"];
    }
    public function setSetting(){
       return $this->executeQuery("UPDATE settings SET explanation=?,facebookUrl=?,InstagramUrl=?,twitterUrl=?,linkedinUrl=?,youtubeUrl=?,logoId=? where id=1",
        array(
            $this->explanation,
            $this->facebookUrl,
            $this->instagramUrl,
            $this->twitterUrl,
            $this->linkedinUrl,
            $this->youtubeUrl,
            $this->logoId
        )) ? true : false;
    }
}
