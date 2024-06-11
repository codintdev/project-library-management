<?php

require '../logica-negocio/Usuario.php';

$objUsuario = new Usuario();

$objUsuario->create($_POST['txtNombreUsuario'], $_POST['txtApellidoUsuario'], $_POST['txtDireccionUsuario'], $_POST['txtTelefonoUsuario']);

if (isset($_POST['btnCancelarUsuario'])) {
  header('Location: usuarios.php');
}

?>

<?php require '../include/header.php'; ?>

<div class="container p-4">

  <p class="h1">Create User</p>

  <?php if (isset($_SESSION['message'])) { ?>
    <div class="alert alert-<?= $_SESSION['message_type']; ?> alert-dismissible fade show" role="alert" style="width: 20%;">
      <?= $_SESSION['message']; ?>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  <?php session_unset(); } ?>

  <div class="card card-body bg-dark">
    <form method="post" action="new_usuario.php" class="row row-cols-4">
      <div class="mb-3 col">
        <label class="col-sm-3 col-form-label">Name</label>
        <input type="text" name="txtNombreUsuario" class="form-control">
      </div>
      <div class="mb-3 col">
        <label class="col-sm-5 col-form-label">Lastname</label>
        <input type="text" name="txtApellidoUsuario" class="form-control">
      </div>
      <div class="mb-3">
        <label class="col-sm-4 col-form-label">Address</label>
        <input type="text" name="txtDireccionUsuario" class="form-control">
      </div>
      <div class="mb-3">
        <label class="col-sm-3 col-form-label">Phone</label>
        <input type="text" name="txtTelefonoUsuario" class="form-control">
      </div>
      <div class="d-grid gap-2 d-md-block align-items-start p-2">
        <input type="submit" name="btnAgregarUsuario" value="Create" class="btn btn-warning">
        <input type="submit" name="btnCancelarUsuario" value="Cancel" class="btn btn-outline-secondary">
      </div>
    </form>
  </div>

</div>

<?php require '../include/footer.php'; ?>

