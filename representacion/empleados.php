<?php

require '../logica/Empleado.php';

$objEmpleado = new Empleado();

?>

<?php require '../include/header.php'; ?>

<div class="container p-4">

  <div class="row">

    <div class="col-auto">
      <p class="h1">Employees</p>
    </div>

    <div class="col-md-8">
      <a href="new_empleado.php" class="btn btn-warning" style="transform: translateX(560%);">New Employee</a>
    </div>

    <form method="post" action="empleados.php" class="d-flex">
      <div class="container" style="width: 30%;">
        <input type="search" name="txtBuscarEmpleado" class="form-control me-2" placeholder="Search" aria-label="Search" style="transform: translateY(-150%) translateX(30%);">
      </div>

      <div class="d-grid gap-2 d-md-block align-items-start p-2">
        <input type="submit" class="btn btn-outline-warning" name="btnBuscarEmpleado" value="Search" style="transform: translateY(-170%) translateX(-230%);">
        <input type="submit" class="btn btn-outline-warning" name="btnFiltrarEmpleado" value="Filter" style="transform: translateY(-170%) translateX(-250%);">
      </div>
    </form>

    <div class="col-xxl-10">
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
          <?php $objEmpleado->index(); ?>
        </tbody>
      </table>
    </div>

  </div>

</div>

<?php require '../include/footer.php'; ?>
