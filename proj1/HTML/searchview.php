
<?php
//  Fait par Simon
    include_once "./CLASSES/USER/user.php";
    include_once "./CLASSES/ALBUMS/Album.php";
    include_once "./CLASSES/IMAGES/Images.php";
    $userList = user::getByName($_GET["search"]);
    $albumList = Album::getByName($_GET["search"]);
    $imageList = images::getByName($_GET["search"]);
?>

<h1 class="my-4">Search results (Utilisateurs):</h1>
<?php
 foreach($userList as $user){
    $user->displayUser();
  }
?>

<h1 class="my-4">Search results (Albums):</h1>
<?php
 foreach($albumList as $album){
   $album->displayAlbum();
  }
?>

<h1 class="my-4">Search results (Images):</h1>
<?php
 
 foreach($imageList as $image){
    $image->displayImage();
  }
?>
