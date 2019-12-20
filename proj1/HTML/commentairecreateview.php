

<div class="container">

  <form method = "post" action = "DOMAINLOGIC/addCommentaire.dom.php">
    <input type="hidden" name="idType" id="idType" value="<?php echo $_GET["idType"] ?>" required>
    <input type="hidden" name="Type" id="Type" value="<?php echo $_GET["Type"] ?>" required>
    <?php
    
      if($_GET["Type"] =="album" )
      {
        $titre = $_GET["Titre"];
       echo "<input type='hidden' name='Titre' id='Titre' value='$titre' required>";
      }
    
    ?>

    <div class="form-group">
            <textarea class="form-control" rows="5" name="contenu" id="contenu" placeholder="Got something to say, punk?" required></textarea>
            <div class="valid-feedback">Valid.</div>
            <div class="invalid-feedback">Please fill out this field.</div>
    </div>
    
    <div class="btn-group">
      <button class="btn btn-success btn-lg mb-4" type="submit">Post that stuff!</button>
      <button class="btn btn-warning btn-lg mb-4" type="reset">Actually, nevermind!</button>
    </div>

    
  </form>

</div>
