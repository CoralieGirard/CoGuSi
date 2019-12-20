<div class="container">
<form method = "post" action = "./DOMAINLOGIC/uplaod.dom.php" enctype="multipart/form-data">
<input type="hidden" name="idAlbum" id="idAlbum" value=<?php echo $_GET["idType"]?> required="">
<div class="form-group">
                  <label for="Fichier">Ajouter Image!</label>
                  <input type="file" class="form-control" name="Fichier" id="Fichier" required>
                  <br>
                  <label for="Description">Description</label>
                  <textarea  class="form-control" name="Description" id="Description" placeholder="Une petite Description avec l'image, svp?" required></textarea>
              </div>
              <button class="btn btn-success btn-lg mb-4" type="submit">Ajouter l'image!</button>

</div>