<?php
    include __DIR__ . "/../CLASSES/ALBUMS/Album.php";
    include __DIR__ . "/../UTILS/sessionhandler.php";

    session_start();

    if(!validateSession()){
        header("Location: ../error.php?ErrorMSG=Not%20logged%20in!");
        die();
    }

    if(!isset($_GET["idAlbum"])){
        header("Location: ../error.php?ErrorMSG=Bad%20Requests!");
        die();
    }

    $album = new Album();
    $album->loadAlbumAvecId($_GET["idAlbum"]);

    if(!$album->getProprietaire() == $_SESSION["userID"]){
        header("Location: ../error.php?ErrorMSG=Bad%20Requests!");
        die();
    }
    
    $album->delete();

    header("Location: ../billboard.php");
    die();
?>
