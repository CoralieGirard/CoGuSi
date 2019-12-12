<?php

/**
 * Album.php
 * Fait par Guillaume Gauvin et Simon Daudelin
 * Include un objet representant un Album  */ 


    include_once __DIR__."/TDGAlbum.php";


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

        public function getProprietaires(){
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

        //

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
            /*

                Devras etre fait une fois que album est faite
            $this->albums  = $res["idAlbum"];
            */

        }

        /**
         * En cours, cette fonction cree Du HTML
         * Entete avec le nom de album et le proprio
         * Body est avec les albums
         * footer est la date de creation
         * 
         * IN PROGRESS (faut faire du Css pour donner les bonnes classes n shit )
         */

        public function toTable(){
            
        }
        
        public function getAlbumByUserId($id){
            $TDG = new TDGAlbum();
            $res = $TDG->getAlbumByUserId($id); 
            if(!$res){
                return false;
            }
            return $res;
        }

        private static function listAllAlbums(){
            $TDG = TDGAlbum::getInstance();
            $res = $TDG->getAllAlbums();
            $TDG = null;
            if(!$res)
            {
              return $res;
            }
            return $res;
        }

        public static function createAlbumList(){
            $TDGRes = Album::listAllAlbums();
            $albumsList = array();
            foreach($TDGRes as $r){
                $album = new Album();
                $album->setIdalbum($r["idAlbum"]);
                $album->setTitre($r["Titre"]);
                $album->setDescription($r["Description"]);
                $album->setProprietaires($r["Proprietaire"]);
                array_push($albumsList, $album);
            }
            return $albumsList;
        }

        public function addAlbum($titre,$description){
            $TDG = TDGAlbum::getInstance();
            $dateCreation = date("Y-m-d H:i:s");
            $res = $TDG->addAlbum($titre, $description, $dateCreation);
            $TDG = null;
            if(!$res)
            {
                return $res;
            }
            return $res;
        }
        
        public function delete(){
            $TDG = TDGAlbum::getInstance();
            $res = $TDG->deleteAlbum($this->idAlbum);
            $TDG = null;
            return $res;
        }

        public function displayAlbum()
        {
            $titre = $this->titre;
            $id = $this->id;
            echo "<div class='card bg-dark mb-4'>";
            echo "<div class='card-header text-left '><a href='displayalbum.php?idAlbum=$id&albumTitre=$titre'><h5>$titre</h5></a>";
            echo "</div>";
            echo "</div>";
        }

        public function displayMyAlbum()
        {
            $titre = $this->titre;
            $id = $this->id;
            echo "<div class='card bg-dark mb-4'>";
            echo "<div class='card-header text-left '><a href='displayalbum.php?idAlbum=$id&albumTitre=$titre'><h5>$titre</h5></a>";
            echo "<form method = 'post' action = 'DOMAINLOGIC/deleteAlbum.dom.php'>";
            echo "<input type='hidden' name='idCommentaire' value='$id'>";
            echo "<button class='btn btn-danger mb-2' type='submit'>Delete album</button>";
            echo "</form>";
            echo "</div>";
            echo "</div>";
        }
    }
?>
