<?php
    include __DIR__ . "/../CLASSES/IMAGES/Images.php";
    include __DIR__ . "/../UTILS/sessionhandler.php";

    session_start();

    if(!validateSession()){
        header("Location: ../error.php?ErrorMSG=Not%20logged%20in!");
        die();
    }

    if(!isset($_POST["idImage"])){
        header("Location: ../error.php?ErrorMSG=Bad%20Requests!");
        die();
    }

    Images::deleteByID($_POST["idImage"]);

    header("Location: ../billboard.php");
    die();
?>