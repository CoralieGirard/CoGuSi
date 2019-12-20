<?php

/**
 * Album.php
 * Fait par Guillaume Gauvin et Simon Daudelin
 * Include un objet representant un Album  */ 


    include_once __DIR__."/TDGAlbum.php";
    include_once __DIR__."../../USER/user.php";
    include_once __DIR__."../../Commentaires/Commentaires.php";


    date_default_timezone_set("America/New_York");
    class Album {

        private $id;
        private $titre;
        private $description;
        private $proprietaire;
        private $dateCreation;
        private $albums;

        public function __construct(){
            $this->albums = array();
        }

        //get

        public function getId(){
            return $this->id;
        }
    
        public function getTitre(){
            return $this->titre;
        }
        
        public function getDescription(){
            return $this->description;
        }

        public function getProprietaire(){
            return $this->proprietaire;
        }

        public function getalbums(){
            return $this->albums;
        }

        //set
        public function setIdAlbum($id){
            $this->id = $id;
        }
    
        public function setTitre($titre){
            $this->titre = $titre;
        }
        
        public function setDescription($description){
            $this->description = $description;
        }

        public function setProprietaires($proprio){
            $this->proprietaire = $proprio;
        }

        public function setDateCreation($date){
            $this->dateCreation = $date;
        }


        public function loadAlbumAvecID($id){
            $TDG = new TDGAlbum();
            $res = $TDG->getbyId($id);

            if(!$res){
                return false;
            }

            $this->id = $res["idAlbum"];
            $this->titre  = $res["Titre"];
            $this->description  = $res["Description"];
            $this->proprietaire  = $res["Proprietaire"];
            $this->dateCreation  = $res["DateCreation"];

        }

        public function loadAlbumByTitre($titre){
            $TDG = new TDGAlbum();
            $res = $TDG->getAlbumByTitre($titre);

            if(!$res){
                return false;
            }

            $this->id = $res["idAlbum"];
            $this->titre  = $res["Titre"];
            $this->description  = $res["Description"];
            $this->proprietaire  = $res["Proprietaire"];
            $this->dateCreation  = $res["DateCreation"];

        }

        public function toTable(){
            
        }
        
        public static function getAlbumByUserId($id){
            $TDG = new TDGAlbum();
            $res = $TDG->getAlbumByUserId($id); 
            return $res;
        }

        private static function listAllAlbums(){
            $TDG = TDGAlbum::getInstance();
            $res = $TDG->getAllAlbums();
            $TDG = null;
            return $res;
        }

        public static function createAlbumList(){
            $TDGRes = Album::listAllAlbums();
            $albumsList = array();
            foreach($TDGRes as $r){
                $album = new Album();
                $album->setIdAlbum($r["idAlbum"]);
                $album->setTitre($r["Titre"]);
                $album->setDescription($r["Description"]);
                $album->setProprietaires($r["Proprietaire"]);
                $album->setDateCreation($r["DateCreation"]);
                array_push($albumsList, $album);
            }
            return $albumsList;
        }

        public static function createAlbumListByProprietaire($proprietaire){
            $TDGRes = Album::getAlbumByUserId($proprietaire);
            $albumsList = array();
            foreach($TDGRes as $r){
                $album = new Album();
                $album->setIdAlbum($r["idAlbum"]);
                $album->setTitre($r["Titre"]);
                $album->setDescription($r["Description"]);
                $album->setProprietaires($r["Proprietaire"]);
                $album->setDateCreation($r["DateCreation"]);
                array_push($albumsList, $album);
            }
            return $albumsList;
        }

        public function addAlbum($titre,$description){
            $TDG = TDGAlbum::getInstance();
            $dateCreation = date("Y-m-d H:i:s");
            $res = $TDG->addAlbum($titre, $description, $dateCreation);
            $TDG = null;
            
            return $res;
        }
        
        public function delete(){
            $TDG = TDGAlbum::getInstance();

            Commentaires::deleteCommentairesByIDAndType($this->id,"album");

            $res = $TDG->deleteAlbum($this->id);
            $TDG = null;
            return $res;
        }

        public function displayAlbum()
        {
            $titre = $this->titre;
            $id = $this->id;
            $description = $this->description;
            $date = $this->dateCreation;
            $proprio = User::getById($this->proprietaire);
            echo "<div class='card bg-dark mb-4'>";
            echo "<div class='card-header text-left'><a href='displayalbum.php?idType=$id&Titre=$titre&Type=album'><h5>$titre</h5></a> By " . $proprio;
            echo "<br><div class='my-3 p-3 bg-white rounded shadow-sm'><h5>Description</h5><br>$description</div>";
            echo "</div>";
            echo $date;
            echo "</div>";
        }

        public function displayMyAlbum()
        {
            $titre = $this->titre;
            $id = $this->id;
            $description = $this->description;
            $date = $this->dateCreation;
            echo "<div class='card bg-dark mb-4'>";
            echo "<div class='card-header text-left '><div class='d-flex justify-content-between align-items-center w-100'><a href='displayalbum.php?idType=$id&Titre=$titre&Type=album'><h5>$titre</h5></a>";
            echo "<form method = 'post' action = 'DOMAINLOGIC/deleteAlbum.dom.php?idAlbum=$id'>";
            echo "<button class='btn btn-danger mb-2' type='submit'>Delete album</button></div>";
            echo "<br><div class='my-3 p-3 bg-white rounded shadow-sm'><h5>Description</h5><br>$description</div>";
            echo "</form>";
            echo "</div>";
            echo $date;
            echo "</div>";
        }

        public function displayAlbumSearch()
        {
            $titre = $this->titre;
            $id = $this->id;
            $description = $this->description;
            $date = $this->dateCreation;
            echo "<div class='card bg-dark mb-4'>";
            echo "<div class='card-header text-left'><a href='displayalbum.php?idType=$id&Titre=$titre&Type=album'><h5>$titre</h5></a>";
            echo "<br><div class='my-3 p-3 bg-white rounded shadow-sm'><h5>Description</h5><br>$description</div>";
            echo "</div>";
            echo $date;
            echo "</div>";
        }
        
        public static function getByName($name)
        {
            $TDG = TDGAlbum::getInstance();
            $res = $TDG->getAlbumByName($name);
            $res = Album::arrayToObject($res);
            return $res;
        }

        //function des array to object static
        public static function arrayToObject($list){
            $newArray = [];
            foreach($list as $obj){
                $temp = new Album();
                $temp->setIdAlbum($obj["idAlbum"]);
                $temp->setTitre($obj["Titre"]);
                $temp->setDescription($obj["Description"]);
                $temp->setProprietaires($obj["Proprietaire"]);
                array_push($newArray, $temp);
            }
            return $newArray;
        }
    }
?>
