<?php

include_once __DIR__ . "/../../UTILS/connector.php";

class ImagesTDG extends DBAO{

    private $tableName;
    private static $instance =null;

    public function __construct(){
        Parent::__construct();
        $this->tableName = "Image";
    }

    public static function getInstance()
    {
        if(self::$instance == null)
        {
            self::$instance = new ImagesTDG();
        }
        
        return self::$instance;
    }

    //create table
    public function createTable(){

        try{
            $conn = $this->connect();
            $query = "CREATE TABLE IF NOT EXISTS ". $this->tableName ." (idImage INTEGER(10) AUTO_INCREMENT PRIMARY KEY,
            URL VARCHAR(1000),
            idAlbum INT,
            Description VARCHAR(1000),
            DateCreation VARCHAR(30)),
            likes INT";
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


    //drop table
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

    public function getAllImages(){

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


    public function getByIdImage($idImage){

        try{
            $conn = $this->connect();
            $query = "SELECT * FROM ". $this->tableName ." WHERE idImage=:id";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':id', $idImage);
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
    
    public function getImageByName($motSearch){
        try{
            $conn = $this->connect();
            $tableName = $this->tableName;
            $query = "SELECT * FROM $tableName WHERE Description Like :motSearch";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':Description', '%'.$motSearch.'%');
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

    public function getByIdAlbum($idAlbum){

        try{
            $conn = $this->connect();
            $query = "SELECT * FROM ". $this->tableName ." WHERE idAlbum=:idAlbum";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':idAlbum', $idAlbum);
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

    public function getByDateCreation($dateCreation){

        try{
            $conn = $this->connect();
            $query = "SELECT * FROM ". $this->tableName ." WHERE DateCreation=:date";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':date', $dateCreation);
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

    public function getByURL($URL){

        try{
            $conn = $this->connect();
            $query = "SELECT * FROM ". $this->tableName ." WHERE URL=:url";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':url', $URL);
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

    public function getLikes()
    {
        try{
            $conn = $this->connect();
            $query = "SELECT likes FROM ". $this->tableName;
            $stmt = $conn->prepare($query);
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

    public function addImage($URL, $idAlbum, $description, $DateCreation){

        try{
            $conn = $this->connect();
            $tableName = $this->tableName;
            $query = "INSERT INTO $tableName (URL, idAlbum, Description, DateCreation, likes) VALUES (:URL, :idAlbum, :description, :date, 0)";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':URL', $URL);
            $stmt->bindParam(':idAlbum', $idAlbum);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':date', $DateCreation);
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

    public function deleteImage($idImage)
    {
        
        try{
            $conn = $this->connect();
            $tableName = $this->tableName;
            $query = "DELETE FROM $tableName WHERE idImage=:idImage";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':idImage', $idImage);
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
}
