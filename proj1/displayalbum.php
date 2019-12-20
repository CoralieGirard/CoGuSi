<?php

include_once "./CLASSES/ALBUMS/Album.php";

  session_start();

  if(!isset($_GET["Titre"])){
    header("Location: error.php?ErrorMSG=Bad%20Request!");
    die();
  }

  $title=$_GET["Titre"];
  $id = $_GET["idType"];

  $Album = new Album();

  $Album->loadAlbumAvecID($id);

    if(isset($_COOKIE["$id"]))
   {
     setcookie("$id", ++$_COOKIE["$id"], time()+ (3600*24*365));
   }
   else
    {
    setcookie("$id", 0, time()+ (3600*24*365));
    }

  $content = array();
  
  

  array_push($content,"/../displayImage.php");

  array_push($content,"/../displayCommentaire.php");
  
  array_push($content, "commentairecreateview.php");

  if(isset($_SESSION["userID"]))
  if($Album->getProprietaire() == $_SESSION["userID"])
  array_push($content,"ajouteImageview.php");

  require_once __DIR__ . "/HTML/masterpage.php";


?>
