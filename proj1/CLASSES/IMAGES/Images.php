<?php
include_once __DIR__ . "/ImagesTDG.php";

date_default_timezone_set("America/New_York");
class Images{
    private $idImage;
    private $URL;
    private $idAlbum;
    private $Description;
    private $DateCreation;
    private $Commentaires;
    private $likes;
    public function __construct(){
      $this->Commentaires = array();
    }
    //getters
    public function getIdImage(){
        return $this->idImage;
    }
    public function getURL(){
        return $this->URL;
    }
    public function getIdAlbum(){
        return $this->idAlbum;
    }
    public function getDescription(){
        return $this->Description;
    }
    public function getDateCreation(){
        return $this->DateCreation;
    }
    public function getLikes(){
        return $this->likes;
    }
    //setters
    public function setIdImage($idImage){
        $this->idImage = $idImage;
    }
    public function setURL($URL){
        $this->URL = $URL;
    }
    public function setIdAlbum($idAlbum){
        $this->idAlbum = $idAlbum;
    }
    public function setDescription($description){
        $this->Description = $description;
    }
    public function setDateCreation($dateCreation){
        $this->DateCreation = $dateCreation;
    }
    public function setLikes($likes){
        $this->likes = $likes;
    }
    /*
        Quality of Life methods (Dans la langue de shakespear (ou QOLM pour les intimes))
    */
    public function loadImageById($idImage){
        $TDG = ImagesTDG::getInstance();
        $res = $TDG->getByIdImage($idImage);
        if(!$res){
            return false;
        }
        $this->idImage = $res["idImage"];
        $this->URL = $res["URL"];
        $this->idAlbum = $res["idAlbum"];
        $this->Description = $res["Description"];
        $this->DateCreation = $res["DateCreation"];
        $this->likes = $res["likes"];
        return true;
    }
    public function loadImageByIdAlbum($idAlbum){
        $TDG = ImagesTDG::getInstance();
        $res = $TDG->getByIdAlbum($idAlbum);
        if(!$res){
            return false;
        }
        $this->idImage = $res["idImage"];
        $this->URL = $res["URL"];
        $this->idAlbum = $res["idAlbum"];
        $this->Description = $res["Description"];
        $this->DateCreation = $res["DateCreation"];
        $this->likes = $res["likes"];
        return true;
    }

    public function loadImageByDateCreation($date){
        $TDG = ImagesTDG::getInstance();
        $res = $TDG->getByDateCreation($date);
        if(!$res){
            return false;
        }
        $this->idImage = $res["idImage"];
        $this->URL = $res["URL"];
        $this->idAlbum = $res["idAlbum"];
        $this->Description = $res["Description"];
        $this->DateCreation = $res["DateCreation"];
        $this->likes = $res["likes"];
        return true;
    }

    public function addImage($URL, $idAlbum, $description){
        $TDG = ImagesTDG::getInstance();
        $dateCreation = date("Y-m-d H:i:s");
        $res = $TDG->addImage($URL, $idAlbum, $description, $dateCreation);
        $TDG = null;
        if(!$res)
        {
            return $res;
        }
        return $res;
    }

    public function displayImage(){

        $idImage = $this->idImage;

        $URL = $this->URL;

        $idAlbum = $this->idAlbum;

        $Description = $this->Description;

        $DateCreation = $this->DateCreation;

        $likes = $this->likes;
        include __DIR__ . "/../../HTML/templateImage.php";
    }

    /*
    STATIC FUNCTIONS
    */

    private static function listAllImages(){
        $TDG = ImagesTDG::getInstance();
        $res = $TDG->getAllImages();
        $TDG = null;
        if(!$res)
        {
          return $res;
        }
        return $res;
    }

    public static function createImageList(){
        $TDGRes = Images::listAllImages();
        $imagesList = array();
        foreach($TDGRes as $r){
            $image = new Images();
            $image->setIdImage($r["idImage"]);
            $image->setURL($r["URL"]);
            $image->setIdAlbum($r["idAlbum"]);
            $image->setDescription($r["Description"]);
            $image->setDateCreation($r["DateCreation"]);
            array_push($imagesList, $image);
        }
        return $imagesList;
    }

    public static function listImagesByIdAlbum($idAlbum){

        $TDG=ImagesTDG::getInstance();
        $TDGRes = $TDG->getByIdAlbum($idAlbum);

        $imagesList = array();

        foreach($TDGRes as $r){
            $image = new Images();
            $image->setIdImage($r["idImage"]);
            $image->setURL($r["URL"]);
            $image->setIdAlbum($r["idAlbum"]);
            $image->setDescription($r["Description"]);
            $image->setDateCreation($r["DateCreation"]);
            array_push($imagesList, $image);
        }

        return $imagesList;
    }

    public static function getURLById($idImage)
    {
        $TDG = ImagesTDG::getInstance();
        $res = $TDG->getByIdImage($idImage);
        return $res["URL"];
    }

    public static function getIDByURL($URL)
    {
        $TDG = ImagesTDG::getInstance();
        $res = $TDG->getByURL($URL);
        return $res["idImage"];
    }
    
        public static function getByName($name)
        {
            $TDG = imagesTDG::getInstance();
            $res = $TDG->getImageByName($name);
            $res = Images::arrayToObject($res);
            return $res;
        }

        public static function arrayToObject($list){
            $newArray = array();
            foreach($list as $obj){
                $temp = new Images();
                $temp->setIdImage($obj["idImage"]);
                $temp->setURL($obj["URL"]);
                $temp->setIdAlbum($obj["idAlbum"]);
                $temp->setDescription($obj["Description"]);
                $temp->setDateCreation($obj["DateCreation"]);
                array_push($newArray, $temp);
            }
            return $newArray;
        }

        public static function deleteImageByIdAlbum($idAlbum)
        {
            $TDG = ImagesTDG::getInstance();
            $res = $TDG->deleteImageByAlbum($idAlbum);
            $TDG = null;
            return $res;
        }
}

 

