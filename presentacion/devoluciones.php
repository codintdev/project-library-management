<?php

require '../logica-negocio/Devolucion.php';

$devolucion = new Devolucion();

?>

<?php require '../include/header.php'; ?>

<div class="container text-center p-4">

  <div class="row">

    <div class="col-auto">
      <p class="h1">Devoluciones</p>
    </div>

    <div class="col-md-8">
      <a href="new_devolucion.php" class="btn btn-warning">Nueva Devolución</a>
    </div>

    <div class="col-xxl-8">
      <table class="table table-dark table-striped table-borderless">
        <thead>
          <tr>
            <th>ID</th>
            <th>Fecha</th>
            <th>Dias prestamo</th>
            <th>Titulo</th>
            <th>Autor</th>
            <th>Stock</th>
            <th>Categoria</th>
            <th>Nombre Usuario</th>
            <th>Apellido</th>
            <th>Dirección</th>
            <th>Telefono</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <?php $devolucion->index(); ?>
        </tbody>
      </table>
    </div>

  </div>

</div>

<?php require '../include/footer.php'; ?>
