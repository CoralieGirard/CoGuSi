


<?php

/*
    Code source fait par: Joel Dusablon Senecal
    modifié par: Simon Daudelin
*/

    include_once __DIR__. "/userTDG.php";

    class User{

        private $id;
        private $email;
        private $username;
        private $password;
        private $idImage;


        public function __construct(){

        }



        //Propriétés
        //get
        public function getId(){
            return $this->id;
        }
    
        public function getEmail(){
            return $this->email;
        }
    
        public function getUsername(){
            return $this->username;
        }
    
        public function getPassword(){
            return $this->password;
        }

        public function getidImage(){
            return $this->idImage;
        }


        //set
        public function setEmail($email){
            $this->email = $email;
        }
    
        public function setUsername($username){
            $this->username = $username;
        }
    
        public function setPassword($password){
            $this->password = $password;
        }

        //image***


        //prendre toute les usagers pour les tests
        public function loadUser($email){
            $TDG = UserTDG::getInstance();
            $resultat = $TDG->getByEmail($email);

            if(!$resultat){
                $TDG = null;
                return false;
            }

            $this->id = $resultat['idUser'];
            $this->email = $resultat['Email'];
            $this->username = $resultat['Username'];
            $this->password = $resultat['Password'];
            $this->idImage = $resultat['idImage'];
    
            $TDG = null;
            return true;
        }
 
        //validation du login
        public function login($email,$pw){

            if(!$this->loadUser($email)){
                return false;
            }

            if(!password_Verify($pw,$this->password)){
                return false;
            }

            return true;
        }

        //validation des enregistrements
        public function validationEmailDisponible($email){

            $TDG = UserTDG::getInstance();

            $res = $TDG->getByEmail($email);

            $TDG = null;

            if(!$res)
            {
                return true;
            }
    
            return false;
        }

        //s'enregistrer
        public function register($email, $username, $pw, $vpw){


            if(!($pw === $vpw) || empty($pw) || empty($vpw))
            {
                return false;
            }

            if(!$this->validationEmailDisponible($email))
            {
                return false;
            }

            $TDG = UserTDG::getInstance();
            $res = $TDG->ajouterUsager($email, $username, password_hash($pw, PASSWORD_DEFAULT));
            $TDG = null;
            return $res;

        }

        public function updateUserInfo($email, $newmail, $newname, $idImage = 0){

            //load user infos
            if(!$this->loadUser($email))
            {
              return false;
            }
    
            if(empty($this->id) || empty($newmail) || empty($newname)){
              return false;
            }
    
            //check if email is already used
            if(!$this->validationEmailDisponible($newmail) && $email != $newmail)
            {
                return false;
            }
    
            $this->email = $newmail;
            $this->username = $newname;
    
            $TDG = UserTDG::getInstance();
            $res = $TDG->updateInfo($this->email, $this->username, $this->id,$this->idImage);
    
            if($res){
              $_SESSION["userName"] = $this->username;
              $_SESSION["userEmail"] = $this->email;
            }
    
            $TDG = null;
            return $res;
        }

        public function updateUserPw($email, $oldpw, $pw, $pwv){

            //load user infos
            if(!$this->loadUser($email))
            {
              return false;
            }
    
            //check if passed param are valids
            if(empty($pw) || $pw != $pwv){
              return false;
            }
    
            //verify password
            if(!passwordVerify($oldpw, $this->password))
            {
                return false;
            }
    
            //create TDG and update to new hash
            $TDG = UserTDG::getInstance();
            $NHP = password_hash($pw, PASSWORD_DEFAULT);
            $res = $TDG->updatePassword($NHP, $this->id);
            $this->password = $NHP;
            $TDG = null;
            //only return true if update_user_pw returned true
            return $res;
        }

        public function updateUserImage($email,$urlImage){
            $TDG = UserTDG::getInstance();
            $res = $TDG->updatePassword($NHP, $this->id);
            $this->password = $NHP;
            $TDG = null;
        }

        public  function getByID($id){

            if(!$this->loadUser($email))
            {
              return false;
            }
    

            $TDG = UserTDG::getInstance();
            $res = $TDG->getById($id);
            $TDG = null;
            return $res["Username"];
        }

        
    }
?>
