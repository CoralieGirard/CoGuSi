<div class="card bg-dark mb-4"><div class="card-header text-left ">
  
  <div class="d-flex justify-content-between align-items-center w-100">
    <?php 
        echo "<a href='ImageCommentaire.php?idType=$idImage&Type=image'><img width='35%' height='35%' src='$URL' alt='$idAlbum#$idImage'></a>";
    ?>
    <form method="post" action="DOMAINLOGIC/deleteImage.dom.php?idAlbum=26">

    <?php 
        echo "<input type='hidden' name='idImage' id='idImage' value=$idImage>";
    ?>

    <button class="btn btn-danger mb-2" type="submit">Delete Image</button>
    </form>
    </div><br>
    <div class="my-3 p-3 bg-white rounded shadow-sm">
        
    <h6><?php echo $Description?></h6></div>
</div>
