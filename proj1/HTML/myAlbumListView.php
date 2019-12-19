<?php
    include "CLASSES/ALBUMS/Album.php";
    $album_list = Album::createAlbumListByProprietaire($_SESSION["userID"]);
?>

<h3 class="my-4">My albums</h3>
<?php
  foreach($album_list as $album){
    $album->displayMyAlbum();
  }
?>
