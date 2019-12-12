<?php
    include __DIR__ . "/..//CLASSES/USER/user.php";
    include __DIR__ . "/../CLASSES/IMAGES/Images.php";

    session_start();

   $_FILES['Image'] =  $_FILES['Fichier'];

   if(isset($_FILES['Image'])){
 
    $target_dir = "Images/";

    //obtenir l'extention du fichier uploader
    $media_file_type = pathinfo($_FILES['Fichier']['name'],PATHINFO_EXTENSION);
  
    // Valid file extensions
    $img_extensions_arr = array("jpg","jpeg","png","gif");
    $vid_extensions_arr = array("webm", "avi", "wmv", "rm", "rmvb", "mp4", "mpeg");

    if(in_array($media_file_type, $img_extensions_arr)){;
        echo "VALID";
    }
    else if(in_array($media_file_type, $vid_extensions_arr)){
        echo "INVALID FILE TYPE";
        die();
    }
    else{
        echo "INVALID FILE TYPE";
        die();
    }

    //creation d'un nom unique pour la "PATH" du fichier
    $path = tempnam("../Images", '');
    unlink($path);
    $file_name = basename($path, ".tmp");
    
    //creation de l'url pour la DB
    $URL = $target_dir . $file_name . "." . $media_file_type;
    
    //deplacement du fichier uploader vers le bon repertoire (Medias)
    move_uploaded_file($_FILES['Image']['tmp_name'], "../" . $URL);

    //create entry in database
    $image = new Images();
    $image -> addImage($URL,null,null);

    
    $Us = new User();
    $Us->loadUser($_SESSION["userEmail"]);

    if($Us->updateUserImage($_SESSION["userEmail"],Images::getIDByURL($URL)))
    echo "FUCKING DID IT MATE";

}


    header("Location: ../myProfile.php");
    die();


?>