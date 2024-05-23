<?php

require '../logica/Usuario.php';

$objUsuario = new Usuario();

?>

<?php require '../include/header.php'; ?>

<div class="container p-4">

  <div class="row">

    <div class="col-auto">
      <p class="h1">Users</p>
    </div>

    <div class="col-md-8">
      <a href="new_usuario.php" class="btn btn-warning" style="transform: translateX(900%);">New User</a>
    </div>

    <div class="container-fluid">
      <form method="post" action="usuarios.php" class="d-flex" role="search">
        <input type="search" name="txtBuscarUsuario" class="form-control me-2" placeholder="Search" aria-label="Search" style="transform: translateY(-150%) translateX(150%); width: 30%;">
        <input type="submit" class="btn btn-outline-warning" name="btnBuscarUsuario" value="Search" style="transform: translateY(-150%) translateX(680%);">
      </form>
    </div>

    <div class="col-xxl-10">
      <table class="table table-dark table-striped table-borderless">
        <thead>
          <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Lastname</th>
            <th>Address</th>
            <th>Phone</th>
            <th>Multa</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <?php $objUsuario->index(); ?>
        </tbody>
      </table>
    </div>

  </div>

</div>

<?php require '../include/footer.php'; ?>
