<?php

include_once __DIR__ . "/ImagesTDG.php";
include_once __DIR__ . "/../Commentaires/Commentaires.php";
include_once __DIR__ . "/../ALBUMS/Album.php";
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
        $idImage = $this->idImage;;
        $URL = $this->URL;
        $idAlbum = $this->idAlbum;
        $Description = $this->Description;
        $DateCreation = $this->DateCreation;
        $likes = $this->likes;
        include __DIR__ . "/../HTML/templateImage.php";
    }

    public function deleteImage()
    {
        $TDG = imagesTDG::getInstance();
        $res = $TDG->deleteImage($this->idImage);
        $TDG = null;
        return $res;
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

    public function displayCommentaire(){ //////////////////////////////////////////////////////////
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

    public function nbLikes()
    {
        return ImagesTDG::getInstance().getLikes();
    }

    public function getProprietaire()
    {
        $res = Album::getProprietaireById($this->idAlbum);
        return $res["Proprietaire"];
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

    public static function getURLById($idImage)
    {
        $TDG = ImagesTDG::getInstance();
        $res = $TDG.getByIdImage($idImage);
        return $res["URL"];
    }

}
