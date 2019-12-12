<div class="container border">
  <h3 class="my-4">Créer album </h3>
  <form method = "post" action = "./DOMAINLOGIC/albumcreate.dom.php">
      <div class="form-group">
          <input type="text" class="form-control" name="titre" id="titre" placeholder="Titre" required><br>
          <input type="text" class="form-control" name="description" id="description" placeholder="Description" required><br>
          <div class="valid-feedback">Valid.</div>
      </div>
      <button class="btn btn-success btn-lg mb-4" type="submit">Create Album</button>
  </form>
</div>
