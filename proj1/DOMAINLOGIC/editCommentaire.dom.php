<?php
    include __DIR__."/../CLASSES/Commentaires/Commentaires.php"; // Pourquoi le nom de la classe a un S , c'est un objet pas plusieurs
    include __DIR__ . "/../UTILS/sessionhandler.php";

    session_start();

    if(!validateSession()){
        header("Location: ../error.php?ErrorMSG=Not%20logged%20in!");
        die();
    }

    if(!isset($_POST["idCommentaire"]) || empty($_POST["contenu"])){
        header("Location: ../error.php?ErrorMSG=Contenue ou Id Invalide!");
        die();
    }

    $commentaire = new Commentaires();
    $commentaire->loadCommentaire($_POST["idCommentaire"]);

    if(!$commentaire->getProprietaire() == $_SESSION["userID"]){
        header("Location: ../error.php?ErrorMSG=Pas le proprietaire du commentaire!".$commentaire->getProprietaire());
        
        die();
    }

    $commentaire->setContenu($_POST["contenu"]);
    $commentaire->update();

    header('Location: ' . $_SERVER['HTTP_REFERER']); // Bad Pratice : Peut etre hijacker , apparament
    die();
    ?>
