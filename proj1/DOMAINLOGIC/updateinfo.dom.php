<?php

/*
    Code source fait par: Joel Dusablon Senecal
    modifié par: Simon Daudelin
*/
  include "../CLASSES/USER/user.php";
  include "../UTILS/formvalidator.php";
  include __DIR__ . "/../UTILS/sessionhandler.php";

  session_start();

  if(!validateSession()){
    header("Location: ../error.php?ErrorMSG=Not%20logged%20in!");
    die();
  }

  $email = $_POST["email"];
  $username = $_POST["username"];

  //verification des parametres
  if(empty($email) && empty($username)){
    header("Location: ../error.php?ErrorMSG=invalid email or username");
    die();
  }

  if(!empty($email) && Validator::validateEmail($email)){
    $newmail = $email;
  }
  else{
    $newmail = $_SESSION["userEmail"];
  }

  if(!empty($username)){
    $newname = $username;
  }
  else{
    $newname = $_SESSION["userName"];
  }

  $user = UserTDG::getInstance();
  if(!$user->update_user_info($_SESSION["userEmail"], $newmail, $newname)){
    header("Location: ../error.php?ErrorMSG=invalid%20request");
    die();
  }

  header("Location: ../billboard.php");
  die();

?>
