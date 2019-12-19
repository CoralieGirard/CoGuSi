<div class="container mt-30">
  <h1 class="mb-4" >Les albums de <?php echo $_GET["username"];?></h1>
    <div class="row">
        <div class="col-sm-8 mb-4">
            <?php 
            $id = $_GET["idUser"];
            include "albumSearchListView.php?idUser=$id"; 
            ?>
        </div>
    </div>
</div>