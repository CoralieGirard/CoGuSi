<?php
    include __DIR__ . "/../CLASSES/Commentaires/Commentaires.php";
    include __DIR__ . "/../UTILS/sessionhandler.php";

    session_start();

    if(!validateSession()){
        header("Location: ../error.php?ErrorMSG=Not%20logged%20in!");
        die();
    }

    if(!isset($_POST["idCommentaire"])){
        header("Location: ../error.php?ErrorMSG=Bad%20Requests!");
        die();
    }

    $commentaire = new Commentaires();
    $commentaire->loadCommentaire($_POST["idCommentaire"]);

    if(!$commentaire->getProprietaire() == $_SESSION["userID"]){
        header("Location: ../error.php?ErrorMSG=Bad%20Requests!");
        die();
    }
    
    $commentaire->delete();

    header('Location: ' . $_SERVER['HTTP_REFERER']); // Bad Pratice : Peut etre hijacker , apparament
    die();
?>
