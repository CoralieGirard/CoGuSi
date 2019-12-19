<?php

/**
 * 
 * TDGAlbum.php
 * * Fait par Guillaume Gauvin et Simon Daudelin
 * Crée une classe pouvant accèder à la base de données
 */

    include __DIR__."/../../UTILS/connector.php";


    class TDGAlbum extends DBAO{

        // nom de la table dans la base de donners
        private $tableName;
        private static $instance = null;


        public function __construct(){
            Parent::__construct();
            $this->tableName="Album"/*s*/;

        }

    public static function getInstance()
    {
        if(self::$instance == null)
        {
            self::$instance = new TDGAlbum();
        }
        return self::$instance;
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
        
        public function getAlbumByName($motSearch){
            try{
                $conn = $this->connect();
                $tableName = $this->tableName;
                $query = "SELECT * FROM $tableName WHERE Titre Like :motSearch";
                $stmt = $conn->prepare($query);
                $stmt->bindParam(':Titre', '%'.$motSearch.'%');
                $stmt->execute();
                $stmt->setFetchMode(PDO::FETCH_ASSOC);
                $result = $stmt->fetch();
            }
            catch(PDOException $e)
            {
                echo "Error: " . $e->getMessage();
            }
            //fermeture de connection PDO
            $conn = null;
            return $result;
        }

        public function addAlbum($titre, $description, $dateCreation){

            try{
                $conn = $this->connect();
                $tableName = $this->tableName;

                $query = "INSERT INTO $tableName (Titre, Proprietaire, Description, DateCreation, likes) VALUES (:titre, :proprio, :description, :date, 0)";
                $stmt = $conn->prepare($query);
                $stmt->bindParam(':titre', $titre);
                $stmt->bindParam(':proprio', $_SESSION["userID"]);
                $stmt->bindParam(':description', $description);
                $stmt->bindParam(':date', $dateCreation);
                $stmt->execute();
                $res = true;
            }
            catch(PDOException $e)
            {
                $res = false;
            }
            //fermeture de connection PDO
            $conn = null;
            return $res;
        }
        
        public function deleteAlbum($idAlbum){
            try{
                $conn = $this->connect();
                $tableName = $this->tableName;
                $query = "DELETE FROM $tableName WHERE idAlbum=:idAlbum";
                $stmt = $conn->prepare($query);
                $stmt->bindParam(':idAlbum', $idAlbum);
                $stmt->execute();
                $resp = true;
            }
    
            catch(PDOException $e)
            {
                $resp = false;
            }
            //fermeture de connection PDO
            $conn = null;
            return $resp;
        }

        public function getAlbumByUserId($id){
            try{
                $conn = $this->connect();
                $query = "SELECT * FROM ". $this->tableName ." WHERE Proprietaire=:id";
                $stmt = $conn->prepare($query);
                $stmt->bindParam(':id', $id);
                $stmt->execute();
                $stmt->setFetchMode(PDO::FETCH_ASSOC);
                $result = $stmt->fetchall();
            }
            catch(PDOException $e)
            {
                return false;
            }
            //fermeture de connection PDO
            $conn = null;
            return $result;
        }

        public function getNewAlbumId($titre, $description)
        {
            try{
                $conn = $this->connect();
                $query = "SELECT idAlbum FROM ". $this->tableName ." WHERE Titre=:id";
                $stmt = $conn->prepare($query);
                $stmt->bindParam(':id', $id);
                $stmt->execute();
                $stmt->setFetchMode(PDO::FETCH_ASSOC);
                $result = $stmt->fetchall();
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
