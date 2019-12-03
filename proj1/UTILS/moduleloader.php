<?php

/*
    Code source fait par: Joel Dusablon Senecal
    modifié par: Simon Daudelin
*/

function loadModules($moduleList){
  foreach($moduleList as $module => $moduleViewRef)
  {
    $path = __DIR__ . "/../HTML/$moduleViewRef";
    include $path;
  }
}

?>
