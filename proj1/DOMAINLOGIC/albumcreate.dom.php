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
    
    // Guillaume here, 
    // J'ai realiser que les apostrophes ' detruisent le HTML (dans les balises <a>.. le lien devien non coerant  )
    // Il est sependant 12h00 , alors je vais prioriser d'autres problemes plus pertinant : comme le fait que l'on peu pas encore ajouter des images 
    // a un album qui nous appartiens.


    if(!$album->addAlbum($title, $description)){
      header("Location: ../error.php?ErrorMSG=Failed%20Adding Album!");
      die();
    }

    

    $album->loadAlbumByTitre($title);
    $idAlbum = $album->getId();

    header("Location: ../displayalbum.php?idType=$idAlbum&Titre=$title&Type=album");
    die();

?>
