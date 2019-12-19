<?php
    include "CLASSES/ALBUMS/Album.php";
    $album_list = Album::createAlbumListByProprietaire($_GET["idUser"]);

    foreach($album_list as $album){
    $album->displayAlbumSearch();
  }
?>
