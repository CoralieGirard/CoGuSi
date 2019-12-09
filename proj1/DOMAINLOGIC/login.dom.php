<?php

/*
    Code source fait par: Joel Dusablon Senecal
    modifié par: Simon Daudelin
*/
    include_once "../CLASSES/USER/user.php";
    include __DIR__ . "/../UTILS/sessionhandler.php";


    session_start();

    if(validateSession()){
        header("Location: ../error.php?ErrorMSG=already%20logged%20in!");
        die();
    }

    //prendre les variables du Post
    $email = $_POST["email"];
    $pw = $_POST["pw"];

    //Validation Posts
    $aUser = new User();

    //validateLogin
    if($aUser->Login($email, $pw))
    {
        login($aUser->getId(), $aUser->getEmail(), $aUser->getUsername());
        header("Location: ../billboard.php");
        die();
    }

    header("Location: ../error.php?ErrorMSG=invalid email or password");
    die();
    ?>
