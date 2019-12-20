<?php
  if(isset($_SESSION["userID"])){
    $name = $_SESSION["userName"];
    
  }
  else{
   
    $name="Anon";
  }
?>

<div class="container mt-30">
  <h1 class="mb-4" >Welcome <?php echo $name ?> </h1>
    <div class="row">
        <div class="col-sm-8 mb-4">
            <?php include "albumlistview.php"; ?>
        </div>
        
        <?php
        if(isset($_SESSION["userID"]))
        {
          echo "<div class='col-sm-4 mb-4'>";
            include 'albumcreationview.php';
          echo "</div>";
        }
        ?>
        
        
    </div>
</div>
