<?php

require '../logica-negocio/Reserva.php';

$reserva = new Reserva();

?>

<?php require '../include/header.php'; ?>

<div class="container text-center p-4">

  <div class="row">

    <div class="col-auto">
      <p class="h1">Reservas</p>
    </div>

    <div class="col-md-8">
      <a href="new_reserva.php" class="btn btn-warning">Nueva Reserva</a>
    </div>

    <div class="col-xxl-12">
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
            <th>Fecha reserva</th>
            <th></th>          
          </tr>
        </thead>
        <tbody>
          <?php $reserva->index(); ?>
        </tbody>
      </table>
    </div>

  </div>

</div>

<?php require '../include/footer.php'; ?>
