<?php

/*
    Code source fait par: Joel Dusablon Senecal
    modifié par: Simon Daudelin
*/
    include __DIR__ . "/../UTILS/sessionhandler.php";

    session_start();

    if(!validateSession()){
        header("Location: ../error.php?ErrorMSG=Not%20logged%20in!");
        die();
    }

    $_SESSION = array();
    unset($_COOKIE["PHPSESSID"]);
    session_destroy();

    header("Location: ../logout.php");
    die();

?>
