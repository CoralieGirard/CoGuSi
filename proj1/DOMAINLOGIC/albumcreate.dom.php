<?php
    include "../CLASSES/ALBUMS/Album.php";
    include __DIR__ . "/../UTILS/sessionhandler.php";

    session_start();

    if(!validateSession()){
      header("Location: ../error.php?ErrorMSG=Not%20logged%20in!");
      die();
    }

    $title = $_POST["titre"];
    $description = $_POST["description"];

    if(empty("$title")){
      header("Location: ../error.php?ErrorMSG=bad%20request!");
      die();
    }

    $album = new Album();
    if(!$album->addAlbum($title, $description)){
      header("Location: ../error.php?ErrorMSG=Bad%20request!");
      die();
    }

    $album->loadAlbumByTitre($title);
    $idAlbum = $album->getId();

    header("Location: ../displayalbum.php?idAlbum=$idAlbum&albumTitle=$title");
    die();

?>
