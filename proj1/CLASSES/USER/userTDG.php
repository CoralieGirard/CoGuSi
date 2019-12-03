<?php

/*
    Code source fait par: Joel Dusablon Senecal
    modifié par: Simon Daudelin
*/

include_once __DIR__ . "/../../UTILS/connector.php";

class UserTDG extends DBAO{

    private $tableName;
    private static $_instance = null;

    public function __construct(){
        Parent::__construct();
        $this->tableName = "Usager";
    }

    public static function getInstance(){
        if(is_null(self::$_instance)){
            self::$_instance = UserTDG::getInstance();
        }
        return self::$_instance;
    }


    //créer la table
    public function createTable(){
        try{
            $conn = $this->connect();
            $tableName = $this->tableName;
            $query = "CREATE TABLE IF NOT EXISTS Usager (idUser INTEGER(10) AUTO_INCREMENT PRIMARY KEY, 
            Username VARCHAR(40) UNIQUE not null, 
            Email VARCHAR(100) UNIQUE not null, 
            Image LONGTEXT, 
            Password VARCHAR(40) not null)";
            $stmt = $conn->prepare($query);
            $stmt->execute();
            $resp = true;
        }
        catch(PDOException $e)
        {
            $resp = false;
        }

        $conn = null;
        return $resp;
    }

//drop la table
    public function dropTable(){

        try{
            $conn = $this->connect();
            $tableName = $this->tableName;
            $query = "DROP TABLE $tableName";
            $stmt = $conn->prepare($query);
            $stmt->execute();
            $resp = true;
        }
        //error catch and msg display
        catch(PDOException $e)
        {
            $resp = false;
        }
        //fermeture de connection PDO
        $conn = null;
        return $resp;
    }

    public function getById($id){
        try{
            $conn = $this->connect();
            $tableName = $this->tableName;
            $query = "SELECT idUser, Email, Username FROM $tableName WHERE idUser=:id";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':idUser', $id);
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

    public function getByEmail($email){
        try{
            $conn = $this->connect();
            $tableName = $this->tableName;
            $query = "SELECT * FROM $tableName WHERE Email=:email";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':email', $email);
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

    public function getByUsername($username){
        try{
            $conn = $this->connect();
            $tableName = $this->tableName;
            $query = "SELECT * FROM $tableName WHERE Username=:Username";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':Username', $username);
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

    public function getAllUsager(){
        try{
            $conn = $this->connect();
            $tableName = $this->tableName;
            $query = "SELECT idUser, Email, Username FROM $tableName";
            $stmt = $conn->prepare($query);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $result = $stmt->fetchAll();
        }

        catch(PDOException $e)
        {
            echo "Error: " . $e->getMessage();
        }
        //fermeture de connection PDO
        $conn = null;
        return $result;
    }

    public function ajouterUsager($email, $username, $password){
        try{
            $conn = $this->connect();
            $tableName = $this->tableName;
            $query = "INSERT INTO $tableName (Email, Username, Password) VALUES (:email, :username, :password)";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':password', $password);
            $stmt->execute();
            $resp =  true;
        }
        catch(PDOException $e)
        {
            $resp =  false;
        }
        //fermeture de connection PDO
        $conn = null;
        return $resp;
    }

    public function updateInfo($email, $username, $id){
        try{
            $conn = $this->connect();
            $tableName = $this->tableName;
            $query = "UPDATE $tableName SET Email=:email, Username=:username WHERE idUser=:id";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':idUser', $id);
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

    public function updatePassword($password, $id){
        try{
            $conn = $this->connect();
            $tableName = $this->tableName;
            $query = "UPDATE $tableName SET Password=:password WHERE idUser=:id";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':password', $password);
            $stmt->bindParam(':idUser', $id);
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

?>
