<?php
    include "CLASSES/ALBUMS/Album.php";
    $album_list = Album::createAlbumList();/////////////////////////////
?>

<h3 class="my-4">My albums</h3>
<?php
  foreach($album_list as $album){
    $album->displayAlbum();////////////////
  }
?>
