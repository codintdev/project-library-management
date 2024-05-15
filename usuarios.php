<?php

require 'logica/Usuario.php';

$objUsuario = new Usuario();
$objUsuario->create($_POST['txtIdUsuario'], $_POST['txtNombreUsuario'], $_POST['txtApellidoUsuario'], $_POST['txtDireccionUsuario'], $_POST['txtTelefonoUsuario']);
$objUsuario->edit($_POST['txtIdUsuario'], $_POST['txtNombreUsuario'], $_POST['txtApellidoUsuario'], $_POST['txtDireccionUsuario'], $_POST['txtTelefonoUsuario']);
$objUsuario->delete($_POST['txtIdUsuario']);

?>

<?php require 'include/header.php'; ?>

<div class="container p-4">

  <div class="row">

    <div class="col-md-4">

      <div class="card card-body bg-dark">
        <form method="post" action="usuarios.php">
          <div class="mb-3">
            ID
            <input type="text" name="txtIdUsuario" placeholder="ID" class="form-control" autofocus>
          </div>
          <div class="mb-3">
            Name
            <input type="text" name="txtNombreUsuario" placeholder="Name" class="form-control">
          </div>
          <div class="mb-3">
            Lastname
            <input type="text" name="txtApellidoUsuario" placeholder="Lastname" class="form-control">
          </div>
          <div class="mb-3">
            Address
            <input type="text" name="txtDireccionUsuario" placeholder="Address" class="form-control">
          </div>
          <div class="mb-3">
            Phone
            <input type="text" name="txtTelefonoUsuario" placeholder="Phone" class="form-control">
          </div>
          
          <br/>

          <div class="d-grid gap-2 col-6 mx-auto">
            <input type="submit" name="btnAgregarUsuario" value="Create" class="btn btn-warning btn-block">
            <input type="submit" name="btnEditarUsuario" value="Update" class="btn btn-warning btn-block">
            <input type="submit" name="btnEliminarUsuario" value="Delete" class="btn btn-danger btn-block">
          </div>
        </form>
      </div>

    </div>

    <div class="col-md-8">

      <table class="table table-dark table-striped table-borderless">
        <thead>
          <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Lastname</th>
            <th>Address</th>
            <th>Phone</th>
          </tr>
        </thead>
        <tbody>
          <?php 
          $objUsuario->index();
          ?>
        </tbody>
      </table>

    </div>

  </div>

</div>

<?php require 'include/footer.php'; ?>
