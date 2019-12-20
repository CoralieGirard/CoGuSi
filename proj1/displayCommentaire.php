<?php
    
    include_once "./CLASSES/Commentaires/Commentaires.php";
    
    $Commentaires = Commentaires::createCommentaireList($_GET["idType"],$_GET["Type"]);



    
    foreach($Commentaires as $Commentaire)
    {
        
        $Commentaire->display();    
    }










?>