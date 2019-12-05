<?php

include_once __DIR__ . "/ImagesTDG.php";
include_once __DIR__ . "/../Commentaires/Commentaires.php";
date_default_timezone_set("America/New_York");

class Images{

    private $idImage;
    private $URL;
    private $idAlbum;
    private $Description;
    private $DateCreation;
    private $Commentaires;

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

    /*
        Quality of Life methods (Dans la langue de shakespear (ou QOLM pour les intimes))
    */
    public function loadImageById($idImage){
        $TDG = ImageTDG::getInstance();
        $res = $TDG->getByIdImage($idImage);

        if(!$res){
            return false;
        }

        $this->idImage = $res["idImage"];
        $this->URL = $res["URL"];
        $this->idAlbum = $res["idAlbum"];
        $this->Description = $res["Description"];
        $this->DateCreation = $res["DateCreation"];

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

    public function displayImage(){ /////////////////////////////////////////////////////////////////////////////////////////////////
        $title = $this->title;
        $id = $this->id;
        echo "<div class='card bg-dark mb-4'>";
        echo "<div class='card-header text-left '><a href='displaythread.php?threadID=$id&threadTitle=$title'><h5>$title</h5></a>";
        echo "</div>";
        echo "</div>";
    }

    /*
    Post related functions
    */
    public function loadCommentaires(){
        $res = Commentaires::createCommentaireList($this->idImage, "Image");

        if(!$res)
        {
            return false;
        }

        $this->Commentaires = $res;
    }

    public function displayCommentaire(){
        if(empty($this->Commentaires)){
            $this->loadCommentaires();
        }

        if(empty($this->Commentaires))
        {
            echo "<h3 class='mb-4'>Aucun commentaire</h3>";
        }
        else{

            foreach($this->Commentaires as $Commentaires => $Commentaire){
                $Commentaire >display();
              }
        }
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

}
