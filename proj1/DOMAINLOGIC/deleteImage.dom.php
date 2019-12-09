<?php
    include __DIR__ . "/../CLASSES/IMAGES/Images.php";
    include __DIR__ . "/../UTILS/sessionhandler.php";

    session_start();

    if(!validate_session()){
        header("Location: ../error.php?ErrorMSG=Not%20logged%20in!");
        die();
    }

    if(!isset($_GET["idImage"])){
        header("Location: ../error.php?ErrorMSG=Bad%20Requests!");
        die();
    }

    $image = new Images();
    $image->loadImageById($_GET["idImage"]);

    if(!$image->getProprietaire() == $_SESSION["userID"]){
        header("Location: ../error.php?ErrorMSG=Bad%20Requests!");
        die();
    }
    
    $image->deleteImage();

    header("Location: ../billboard.php");
    die();
?>