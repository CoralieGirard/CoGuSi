<?php

/**
 * Album.php
 * Fait par Guillaume Gauvin
 * Include un objet representant un Album  */ 


    include_once __DIR__."/TDGAlbum.php";



    
    class Album {

        private $id;
        private $titre;
        private $description;
        private $proprietaire;
        private $dateCreation;
        private $images;

        public function __construct(){
            $this->images = array();
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

        public function getImages(){
            return $this->images;
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

                Devras etre fait une fois que Image est faite
            $this->images  = $res["idAlbum"];
            */

        }

        /**
         * En cours, cette fonction cree Du HTML
         * Entete avec le nom de album et le proprio
         * Body est avec les images
         * footer est la date de creation
         * 
         * IN PROGRESS (faut faire du Css pour donner les bonnes classes n shit )
         */

        public function toTable(){

        }

    }




?>