<?php

require '../logica-negocio/Prestamo.php';

$prestamo = new Prestamo();

?>

<?php require '../include/header.php'; ?>

<div class="container text-center p-4">

  <div class="row">

    <div class="col-auto">
      <p class="h1">Prestamos</p>
    </div>

    <div class="col-md-8">
      <a href="new_prestamo.php" class="btn btn-warning">Nuevo Prestamo</a>
    </div>

    <div class="col-xxl-8">
      <table class="table table-dark table-striped table-borderless">
        <thead>
          <tr>
            <th>ID</th>
            <th>Usuario</th>
            <th>Apellido</th>
            <th>Dirección</th>
            <th>Telefono</th>
            <th>Libro</th>
            <th>Autor</th>
            <th>Stock</th>
            <th>Categoria</th>
            <th>Fecha prestamo</th>   
            <th>Empleado</th>
            <th>Cargo</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <?php $prestamo->index(); ?>
        </tbody>
      </table>
    </div>

  </div>

</div>

<?php require '../include/footer.php'; ?>
