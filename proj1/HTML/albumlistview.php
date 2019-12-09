<?php
    include "CLASSES/ALBUM/album.php";
    $thread_list = Thread::createAlbumList();
?>

<h3 class="my-4">Threads</h3>
<?php
  foreach($thread_list as $thread){
    $thread->displayAlbum();
  }
  echo "<h3 class=\"my-4\">Top 5</h3>";
  var_dump($_COOKIE);

  arsort($_COOKIE);
  $thread = new Album();
  $compteur = 0;

  foreach($_COOKIE as $cookie=>$value)
  {
    if($compteur == 0)
    {
      $compteur++;
    }
    else if($compteur != 6)
    {
      $thread->loadAlbumById($cookie);
      $thread->displayAhread();
      $compteur++;
    }
  }
?>
