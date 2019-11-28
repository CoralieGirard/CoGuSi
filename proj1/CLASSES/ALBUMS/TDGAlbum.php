<?php

/**
 * 
 * TDGAlbum.php
 * Créer par Guillaume Gauvin
 * Crée une classe pouvant accèder à la base de données
 */

    include __DIR__."/../../UTILS/connector.php";


    class TDGAlbum extends DBAO{

        // nom de la table dans la base de donners
        private $tableName;
        private static $instance = null;


        private function __construct(){
            Parent::__construct();
            $this->tableName="Album"/*s*/;

        }

        public static getInstance(){
            if($this->instance == null)
            {
                $this->instance = new TDGAlbum();
                return $this->instance;
            }
            else
            {
                return $this->instance;
            }

        }
 
        public function createTable(){
            try{
                
                $conn=$this->connect();
                $query = "CREATE TABLE IF NOT EXISTS Album
                (
                idAlbum INTEGER(10) AUTO_INCREMENT PRIMARY KEY,
                Titre VARCHAR(100),
                Proprietaire VARCHAR(40),
                Description LONGTEXT,
                DateCreation VARCHAR(40)
                )";
                $stmt = $conn->prepare($query);
                $stmt->execute();
                $resp = true;

            }
             //error catch
            catch(PDOException $e)
            {
                $resp = false;
            }
            //fermeture de connection PDO
            $conn = null;
            return $resp;


        }
        
        public function dropTable(){
            try{
                $conn = $this->connect();
                $query = "DROP TABLE ". $this->tableName;
                $stmt = $conn->prepare($query);
                $stmt->execute();
                $resp = true;
            }
            //error catch
            catch(PDOException $e)
            {
                $resp = false;
            }
            //fermeture de connection PDO
            $conn = null;
            return $resp;

        }

        public function addAlbum($nomUsager,$titre,$description){
            
            try{
            $conn = $this->connect();
            $query = "INSERT INTO Album (:titre,:usager,:description,:dateCreation)";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':titre', $titre);
            $stmt->bindParam(':usager', $nomUsager);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':dateCreation', date("Y-m-d H:i:s"));
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $result = $stmt->fetchAll();
            }
            catch(PDOException $e)
            {
                $result = false;
            }
            //fermeture de connection PDO
            $conn = null;
            return $result;

        }

        public function deleteAlbum($id){
            try{
                $conn = $this->connect();
                $query = "DELETE FROM ". $this->tableName ." WHERE idAlbum=:id";
                $stmt = $conn->prepare($query);
                $stmt->bindParam(':id', $id);
                $stmt->execute();
                $stmt->setFetchMode(PDO::FETCH_ASSOC);
                $result = $stmt->fetchAll();
            }
             //error catch
            catch(PDOException $e)
            {
                $result = false;
            }
            //fermeture de connection PDO
            $conn = null;
            return $result;
        }

        public function getAllAlbums(){
            try{
                $conn = $this->connect();
                $query = "SELECT * FROM ". $this->tableName;
                $stmt = $conn->prepare($query);
                $stmt->execute();
                $stmt->setFetchMode(PDO::FETCH_ASSOC);
                $result = $stmt->fetchAll();
            }
             //error catch
            catch(PDOException $e)
            {
                $result = false;
            }
            //fermeture de connection PDO
            $conn = null;
            return $result;
        }
        
        public function getbyId($id){
            try{
                $conn = $this->connect();
                $query = "SELECT * FROM ". $this->tableName ." WHERE idAlbum=:id";
                $stmt = $conn->prepare($query);
                $stmt->bindParam(':id', $id);
                $stmt->execute();
                $stmt->setFetchMode(PDO::FETCH_ASSOC);
                $result = $stmt->fetch();
            }
            catch(PDOException $e)
            {
                return false;
            }
            //fermeture de connection PDO
            $conn = null;
            return $result;
        }
    }

        




?>