

<?php

session_start();



$title="Image";


$content=array();

 

array_push($content,"/../displayImage.php");
array_push($content,"/../displayCommentaire.php");
array_push($content, "commentairecreateview.php");

require_once __DIR__ . "/HTML/masterpage.php";



?>