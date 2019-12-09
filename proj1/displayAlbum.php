<?php
  session_start();

  if(!isset($_GET["AlbumID"])){
    header("Location: error.php?ErrorMSG=Bad%20Request!");
    die();
  }

  $title=$_GET["threadTitle"];
  $id = $_GET["threadID"];

  if(isset($_COOKIE["$id"]))
  {
    setcookie("$id", ++$_COOKIE["$id"], time()+ (3600*24*365));
  }
  else
  {
    setcookie("$id", 0, time()+ (3600*24*365));
  }

  $content = array();
  array_push($content, "postlistview.php");
  array_push($content, "postcreateview.php");

  require_once __DIR__ . "/HTML/masterpage.php";


?>
