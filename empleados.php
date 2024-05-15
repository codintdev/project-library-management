<?php

require 'logica/Empleado.php';

$objEmpleado = new Empleado();

?>

<?php require 'include/header.php'; ?>

<div class="container text-center p-4">

  <div class="row">

    <div class="col-auto">
      <p class="h1">Employees</p>
    </div>

    <div class="col-md-8">
      <p><a href="new_empleado.php" class="btn btn-warning">New Employee</a></p>
    </div>

    <div class="col-xxl-8">

      <table class="table table-dark table-striped table-borderless">
        <thead>
          <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Lastname</th>
            <th>Charge</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <?php
          $objEmpleado->index();
          ?>
        </tbody>
      </table>

    </div>

  </div>

</div>

<?php require 'include/footer.php'; ?>
