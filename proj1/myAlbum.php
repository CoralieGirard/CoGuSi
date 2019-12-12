<?php
    session_start();
    include "UTILS/sessionhandler.php";

    $title = "myAlbum";

    $content = array();

    $module = "myAlbumview.php";
    array_push($content, $module);

    require_once __DIR__ . "/HTML/masterpage.php";

?>