
<?php
//  Fait par Simon
    include "./USER/userTDG.php";
    include "./ALBUMS/albumTDG.php";
    include "./IMAGES/imagesTDG.php";
    $userList = getUsernameByName($_GET["search"]);
    $albumList = getAlbumByName($_GET["search"]);
    $imageList = getImageByName($_GET["search"]);
?>

<h1 class="my-4">Search results (users):</h1>
<?php
 foreach($userList as $user){

  }
?>

<h1 class="my-4">Search results (Albums):</h1>
<?php
 foreach($albumList as $album){

  }
?>

<h1 class="my-4">Search results (Images):</h1>
<?php
 foreach($imageList as $image){
  
  }
?>
