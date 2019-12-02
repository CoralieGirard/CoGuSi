<?php
    include __DIR__ . "/../CLASSES/Commentaires/Commentaires.php";
    include __DIR__ . "/../UTILS/sessionhandler.php";

    session_start();

    if(!validate_session()){
        header("Location: ../error.php?ErrorMSG=not%20logged%20in!");
        die();
    }

    if(!isset($_POST["Contenu"])){
      header("Location: ../error.php?ErrorMSG=Bad%20Request");
      die();
    }

    $Contenu = $_POST["Contenu"];
    $Proprietaire = $_SESSION["userID"];
    $idType = $_GET["idType"];
    $Type = $_GET["Type"];

    $commentaire = new Commentaires();

    if(!$commentaire->addCommentaire($idType, $Type, $Contenu, $Proprietaire)){
      header("Location: ../error.php?ErrorMSG=Bad%20Request");
      die();
    }

    header("Location: ../displayThread.php?threadID=$threadID&threadTitle=$threadTitle");/////////////////////////
    die();

 ?>