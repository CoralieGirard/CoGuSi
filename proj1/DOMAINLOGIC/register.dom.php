<?php

/*
    Code source fait par: Joel Dusablon Senecal
    modifié par: Simon Daudelin
*/
    include "../CLASSES/USER/user.php";
    include "../UTILS/formvalidator.php";
    include __DIR__ . "/../UTILS/sessionhandler.php";

    session_start();

    if(validateSession()){
        header("Location: ../error.php?ErrorMSG=Already%20logged!");
        die();
    }

    //prendre les variables du Post
    $email = $_POST["email"];
    $username = $_POST["username"];
    $pw = $_POST["pw"];
    $pwv = $_POST["pwValidation"];

    //Validation Posts
    if(!Validator::validateEmail($email) || !Validator::validate_password($pw))
    {
        http_response_code(400);
        header("Location: ../error.php?ErrorMSG=invalid email or password");
        die();
    }

    $aUser = new User();

    //validateLogin
    if(!$aUser->register($email, $username, $pw, $pwv))
    {
        http_response_code(400);
        header("Location: ../error.php?ErrorMSG=invalid email or password");
        die();
    }

    header("Location: ../login.php");
    die();
?>
