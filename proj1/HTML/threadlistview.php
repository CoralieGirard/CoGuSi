<?php
    include "CLASSES/THREAD/thread.php";
    $thread_list = Thread::create_thread_list();
?>

<h3 class="my-4">Threads</h3>
<?php
  foreach($thread_list as $thread){
    $thread->display_thread();
  }
  echo "<h3 class=\"my-4\">Top 5</h3>";
  var_dump($_COOKIE);

  arsort($_COOKIE);
  $thread = new Thread();
  $compteur = 0;

  foreach($_COOKIE as $cookie=>$value)
  {
    if($compteur == 0)
    {
      $compteur++;
    }
    else if($compteur != 6)
    {
      $thread->load_thread_by_id($cookie);
      $thread->display_thread();
      $compteur++;
    }
  }
?>
