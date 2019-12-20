<?php
    include __DIR__ . "/../CLASSES/Commentaires/Commentaires.php";
    include __DIR__ . "/../UTILS/sessionhandler.php";

    session_start();

    if(!validateSession()){
        header("Location: ../error.php?ErrorMSG=not%20logged%20in!");
        die();
    }

    if(!isset($_POST["contenu"])){
      header("Location: ../error.php?ErrorMSG=Contenu%20Failed");
      die();
    }

    $Contenu = $_POST["contenu"];
    $Proprietaire = $_SESSION["userID"];
    $idType = $_POST["idType"];
    $Type = $_POST["Type"];

    $commentaire = new Commentaires();



    if(!$commentaire->addCommentaire($idType, $Type, $Contenu, $Proprietaire)){
      //header("Location: ../error.php?ErrorMSG=Mission%20Failed%20".$idType."%20".$Type);
      die();
    }

    if($Type == "album")
    {
    $titre =  $_POST["Titre"];
    header("Location: ../displayalbum.php?idType=$idType&Type=$Type&Titre=$titre");
    }
    else if($Type == "image")
    header("Location: ../ImageCommentaire.php?idType=".$idType."&Type=".$Type);


    die();

 ?>
