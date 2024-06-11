<?php

require '../logica-negocio/Usuario.php';

$usuario = new Usuario();

?>

<?php require '../include/header.php'; ?>

<div class="container p-4">

  <div class="row">

    <div class="col-auto">
      <p class="h1">Usuarios</p>
    </div>

    <div class="col-md-8">
      <a href="new_usuario.php" class="btn btn-warning">Nuevo Usuario</a>
    </div>

    <div class="container-fluid">
      <form method="post" action="usuarios.php" class="d-flex" role="search">
        <input type="search" name="txtBuscarUsuario" class="form-control me-2" placeholder="Search" aria-label="Search">
        <input type="submit" class="btn btn-outline-warning" name="btnBuscarUsuario" value="Search">
      </form>
    </div>

    <div class="col-xxl-10">
      <table class="table table-dark table-striped table-borderless">
        <thead>
          <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Dirección</th>
            <th>Telefono</th>
            <th>Multa</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <?php $usuario->index(); ?>
        </tbody>
      </table>
    </div>

  </div>

</div>

<?php require '../include/footer.php'; ?>
