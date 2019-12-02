<?php
    include __DIR__ . "/../CLASSES/Commentaires/Commentaire.php";
    include __DIR__ . "/../UTILS/sessionhandler.php";

    session_start();

    if(!validate_session()){
        header("Location: ../error.php?ErrorMSG=Not%20logged%20in!");
        die();
    }

    if(!isset($_GET["idCommentaire"]) || empty($_POST["Contenu"])){
        header("Location: ../error.php?ErrorMSG=Bad%20Requests!");
        die();
    }

    $commentaire = new Commentaires();
    $commentaire->loadCommentaire($_GET["idCommentaire"]);

    if(!$commentaire->getProprietaire() == $_SESSION["userID"]){
        header("Location: ../error.php?ErrorMSG=Bad%20Requests!");
        die();
    }

    $commentaire->setContenu($_POST["Contenu"]);
    $commentaire->update();

    header("Location: ../billboard.php");
    die();
    ?>