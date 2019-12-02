<div class="card mb-4">
  <div class="card-header bg-dark text-left">
    <h5 class="text-left text-light"><?php echo $auteur, "#",$Proprietaire ?></h5>
  </div>
  <div class="card-body text-left">
    <p class="card-text"><?php echo $Contenu ?></p>
  </div>

  <?php 

  if(isset($_SESSION["userID"]) && $Proprietaire == $_SESSION["userID"]){

    echo "<div class='card-footer text-left'>
    <button class='btn btn-secondary mb-2' data-toggle='collapse' data-target='#col$idCommentaire'>Edit post</button>
    <div id='col$idCommentaire' class='collapse'>

    <form method = 'post' action = 'DOMAINLOGIC/editpost.dom.php'>

      <div class='form-group'>
        <input type='hidden' name='postID' value='$idCommentaire'>
        <textarea rows='5' name='content' id='content' placeholder='Got something wrong, punk?' required></textarea>
        <div class='valid-feedback'>Valid.</div>
        <div class='invalid-feedback'>Please fill out this field.</div>
      </div>

      <div class='form-group'>
        <button class='btn btn-success mb-2' type='submit'>Submit</button>
      </div>

    </form>


    <form method = 'post' action = 'DOMAINLOGIC/deletepost.dom.php'>

      <input type='hidden' name='postID' value='$idCommentaire'>
      <button class='btn btn-danger mb-2' type='submit'>Delete post</button>

    </form>
    </div>
    </div>";

  }
  ?>

</div>
