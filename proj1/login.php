<?php
    session_start();
    include "UTILS/sessionhandler.php";

    if(validateSession())
    {
        header("Location: error.php?ErrorMSG=Already%20Logged!");
        die();
    }

    //load view content
    $module = "loginview.php";
    $content = array();
    array_push($content, $module);

    //variables used in the loaded module
    $title = "Login";

    //load the masterpage
    require_once __DIR__ . "/HTML/masterpage.php";

?>
