<?php

require '../logica/Usuario.php';

$objUsuario = new Usuario();

$objUsuario->info($_GET['id_usuario']);
$objUsuario->edit($_GET['id_usuario'], $_POST['txtNombreUsuario'], $_POST['txtApellidoUsuario'], $_POST['txtDireccionUsuario'], $_POST['txtTelefonoUsuario']);
$objUsuario->delete($_GET['id_usuario']);

if (isset($_POST['btnCancelarUsuario'])) {
    header('Location: usuarios.php');
}

?>

<?php require '../include/header.php'; ?>

<div class="container p-4">

  <p class="h1">Edit User</p>

  <?php if (isset($_SESSION['message'])) { ?>
    <div class="alert alert-<?= $_SESSION['message_type']; ?> alert-dismissible fade show" role="alert" style="width: 20%;">
        <?= $_SESSION['message']; ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  <?php session_unset(); } ?>

  <div class="card card-body bg-dark">
    <form method="post" action="edit_usuario.php?id_usuario=<?= $_GET['id_usuario']; ?>" class="row row-cols-4">
      <div class="mb-3 col">
        <label class="col-sm-3 col-form-label">Name</label>
        <input type="text" name="txtNombreUsuario" class="form-control" value="<?= $objUsuario->getNombre(); ?>">
      </div>
      <div class="mb-3 col">
        <label class="col-sm-5 col-form-label">Lastname</label>
        <input type="text" name="txtApellidoUsuario" class="form-control" value="<?= $objUsuario->getApellido(); ?>">
      </div>
      <div class="mb-3">
        <label class="col-sm-4 col-form-label">Address</label>
        <input type="text" name="txtDireccionUsuario" class="form-control" value="<?= $objUsuario->getDireccion(); ?>">
      </div>
      <div class="mb-3">
        <label class="col-sm-3 col-form-label">Phone</label>
        <input type="text" name="txtTelefonoUsuario" class="form-control" value="<?= $objUsuario->getTelefono(); ?>">
      </div>
      <div class="d-grid gap-2 d-md-block align-items-start p-2">
        <input type="submit" name="btnEditarUsuario" value="Save changes" class="btn btn-warning">
        <input type="submit" name="btnCancelarUsuario" value="Cancel" class="btn btn-outline-secondary" style="transform: translateY(0%) translateX(0%);">
        <input type="submit" name="btnEliminarUsuario" value="Delete" class="btn btn-danger" style="transform: translateY(-550%) translateX(1300%);">
      </div>
    </form>
  </div>

</div>

<?php require '../include/footer.php'; ?>

