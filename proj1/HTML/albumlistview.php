<?php
    include "CLASSES/ALBUMS/Album.php";
    $album_list = Album::createAlbumList();
?>

<h3 class="my-4">All albums</h3>
<?php
  foreach($album_list as $album){
    $album->displayAlbum();
  }
  echo "<h3 class=\"my-4\">Top 5</h3>";
  var_dump($_COOKIE);

  arsort($_COOKIE);
  $album = new Album();
  $compteur = 0;

  foreach($_COOKIE as $cookie=>$value)
  {
    if($compteur == 0)
    {
      $compteur++;
    }
    else if($compteur != 6)
    {
      $album->loadAlbumById($cookie);
      $album->displayAlbum();
      $compteur++;
    }
  }
?>
