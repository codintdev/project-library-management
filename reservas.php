<?php

require 'logica/Reserva.php';

$objReserva = new Reserva();

?>

<?php require 'include/header.php'; ?>

<div class="container text-center p-4">

  <div class="row">

    <div class="col-auto">
      <p class="h1">Reservations</p>
    </div>

    <div class="col-md-8">
      <p><a href="new_reserva.php" class="btn btn-warning">New Reservation</a></p>
    </div>

    <div class="col-xxl-8">

      <table class="table table-dark table-striped table-borderless">
        <thead>
          <tr>
            <th>ID</th>
            <th>ID user</th>
            <th>Name</th>
            <th>Lastname</th>
            <th>Address</th>
            <th>Phone</th>
            <th>Title</th>
            <th>Author</th>
            <th>Stock</th>
            <th>Category</th>
            <th>Date reservation</th>
            <th></th>          
          </tr>
        </thead>
        <tbody>
          <?php 
          $objReserva->index();
          ?>
        </tbody>
      </table>

    </div>

  </div>

</div>

<?php require 'include/footer.php'; ?>
