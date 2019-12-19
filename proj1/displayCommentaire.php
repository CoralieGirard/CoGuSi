<?php
    
    include __DIR__ . "/CLASSES/Commentaires/Commentaires.php";
    
    $Boi = Commentaires::createCommentaireList($_GET["idImage"],$_GET["Type"]);

    foreach($Boi as $Na)
        $Na->display();    











?>