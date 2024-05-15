<?php

require 'logica/Prestamo.php';

$objPrestamo = new Prestamo();

?>

<?php require 'include/header.php'; ?>

<div class="container text-center p-4">

  <div class="row">

    <div class="col-auto">
      <p class="h1">Loans</p>
    </div>

    <div class="col-md-8">
      <p><a href="new_prestamo.php" class="btn btn-warning">New Loan</a></p>
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
            <th>Date loan</th>
            <th>Day loan</th>     
            <th>Name</th>
            <th>Charge</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <?php 
          $objPrestamo->index();
          ?>
        </tbody>
      </table>

    </div>

  </div>

</div>

<?php require 'include/footer.php'; ?>
