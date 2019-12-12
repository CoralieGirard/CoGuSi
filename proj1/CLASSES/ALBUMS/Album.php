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


        public function getId(){
            return $this->id;
        }
    
        public function getTitle(){
            return $this->title;
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

        public function loadAlbumAvecID($id){
            $TDG = new TDGAlbum();
            $res = $TDG->getbyId($id);

            if(!res){
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
            if(!res){
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
                $album->setURL($r["URL"]);
                $album->setIdAlbum($r["idAlbum"]);
                $album->setDescription($r["Description"]);
                $album->setDateCreation($r["DateCreation"]);
                array_push($albumsList, $album);
            }
            return $albumsList;
        }

        public function addAlbum($titre,$description){
            $TDG = ImagesTDG::getInstance();
            $dateCreation = date("Y-m-d H:i:s");
            $res = $TDG->addImage($titre, $description, $dateCreation);
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
    }
?>
