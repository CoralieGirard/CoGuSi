<?php
  session_start();

  if(!isset($_GET["albumTitle"])){
    header("Location: error.php?ErrorMSG=Bad%20Request!");
    die();
  }

  $title=$_GET["albumTitle"];
  $id = $_GET["albumID"];

  if(isset($_COOKIE["$id"]))
  {
    setcookie("$id", ++$_COOKIE["$id"], time()+ (3600*24*365));
  }
  else
  {
    setcookie("$id", 0, time()+ (3600*24*365));
  }

  $content = array();
  array_push($content, "commentairetemplate.php");
  array_push($content, "commentairecreateview.php");

  require_once __DIR__ . "/HTML/masterpage.php";


?>
