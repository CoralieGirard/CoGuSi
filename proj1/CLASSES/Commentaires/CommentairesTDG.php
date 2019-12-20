<?php

include_once __DIR__ . "/../../UTILS/connector.php";


class commentaireTDG extends DBAO{

    private $tableName;
    private static $instance = null;

    public static function getInstance()
    {
        if(self::$instance == null)
        {
            self::$instance = new commentaireTDG();
        }
        
        return self::$instance;
    }

    public function __construct(){
        Parent::__construct();
        $this->tableName = "commentaire";
    }

    //create table
    public function createTable(){

        try{
            $conn = $this->connect();
            $query = "CREATE TABLE IF NOT EXISTS ". $this->tableName ."(idCommentaire INTEGER(10) AUTO_INCREMENT PRIMARY KEY,
            idType INT,
            Type VARCHAR(30),
            DateCreation VARCHAR(30),
            Contenu LONGTEXT,
            Proprietaire VARHCAR(40))";
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


    public function getByIdCommentaire($idCommentaire){

        try{
            $conn = $this->connect();
            $query = "SELECT * FROM ". $this->tableName ." WHERE idCommentaire=:idCommentaire";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':idCommentaire', $idCommentaire);
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

    public function getByIdType($idType, $Type){

        try{
            $conn = $this->connect();
            $query = "SELECT * FROM ". $this->tableName ." WHERE idType=:idType AND Type=:type";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':idType', $idType);
            $stmt->bindParam(':type', $Type);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $result = $stmt->fetchall();
        }

        catch(PDOException $e)
        {
            echo "Error: " . $e->getMessage();
        }
        //fermeture de connection PDO
        $conn = null;
        return $result;
    }

    public function getByType($type){

        try{
            $conn = $this->connect();
            $query = "SELECT * FROM ". $this->tableName ." WHERE Type=:type";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':type', $type);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $result = $stmt->fetchAll();
        }

        catch(PDOException $e)
        {
            echo "Error: " . $e->getMessage();
            return false;
        }
        //fermeture de connection PDO
        $conn = null;
        return $result;
    }


    public function getAllCommentaires(){

        try{
            $conn = $this->connect();
            $query = "SELECT * FROM " . $this->tableName;
            $stmt = $conn->prepare($query);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $result = $stmt->fetchAll();
        }

        catch(PDOException $e)
        {
            echo "Error: " . $e->getMessage();
            return false;
        }
        //fermeture de connection PDO
        $conn = null;
        return $result;
    }

    public function getByDate($date){

        try{
            $conn = $this->connect();
            $tableName = $this->tableName;
            $query = "SELECT * FROM $tableName WHERE DateCreation=:date";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':date', $date);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $result = $stmt->fetchAll();
        }

        catch(PDOException $e)
        {
            return false;
        }
        //fermeture de connection PDO
        $conn = null;
        return $result;
    }

    public function getByProprietaire($proprietaire){

        try{
            $conn = $this->connect();
            $query = "SELECT * FROM ". $this->tableName ." WHERE Proprietaire=:Proprietaire";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':Proprietaire', $proprietaire);
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


    public function addCommentaire($idType, $type, $date, $content, $proprietaire){

        try{
            $conn = $this->connect();
            $tableName = $this->tableName;
            $query = "INSERT INTO $tableName (idType, Type, DateCreation, Contenu, proprietaire) VALUES (:idType, :Type, :Date, :contenu, :proprietaire)";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':idType', $idType);
            $stmt->bindParam(':Type', $type);
            $stmt->bindParam(':Date', $date);
            $stmt->bindParam(':contenu', $content);
            $stmt->bindParam(':proprietaire', $proprietaire);
            $stmt->execute();
            $resp = true;
        }

        catch(PDOException $e)
        {
            $resp =  false;
        }
        //fermeture de connection PDO
        $conn = null;
        return $resp;
    }

    public function editCommentaire($contenu, $idCommentaire){

        try{
            $conn = $this->connect();
            $tableName = $this->tableName;
            $query = "UPDATE $tableName SET Contenu=:contenu WHERE idCommentaire=:idCommentaire";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':contenu', $contenu);
            $stmt->bindParam(':idCommentaire', $idCommentaire);
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

    public function deleteCommentaire($idCommentaire){

        try{
            $conn = $this->connect();
            $tableName = $this->tableName;
            $query = "DELETE FROM $tableName WHERE idCommentaire=:idCommentaire";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':idCommentaire', $idCommentaire);
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
