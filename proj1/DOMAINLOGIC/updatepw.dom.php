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

  if(!isset($_POST["oldpw"]) || !isset($_POST["newpw"])){
    header("Location: ../error.php?ErrorMSG=invalid%20password");
    die();
  }

  $oldpw = $_POST["oldpw"];
  $newpw = $_POST["newpw"];
  $pwval = $_POST["pwValidation"];


  if(!Validator::validatePassword($newpw)){
    header("Location: ../error.php?ErrorMSG=invalid%20password");
    die();
  }

  $user = UserTDG::getInstance();
  if(!$user->updatePassword($_SESSION["userEmail"], $oldpw, $newpw, $pwval)){
    header("Location: ../error.php?ErrorMSG=Bad%20request");
    die();
  }

  header("Location: ../billboard.php");
  die();

 ?>
