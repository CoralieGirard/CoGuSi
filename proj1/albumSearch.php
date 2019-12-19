<?php
    session_start();
    include "UTILS/sessionhandler.php";

    $title = "albumSearch";

    $content = array();

    $id = $_GET["idUser"];
    $username = $_GET["username"];

    $module = "albumSearchview.php?idUser=$id&username=$username";
    array_push($content, $module);

    require_once __DIR__ . "/HTML/masterpage.php";

?>