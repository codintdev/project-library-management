<?php

require '../logica-negocio/Empleado.php';

$empleado = new Empleado();

?>

<?php require '../include/header.php'; ?>

<div class="container p-4">

  <div class="row">

    <div class="col-auto">
      <p class="h1">Empleados</p>
    </div>

    <div class="col-md-8">
      <a href="new_empleado.php" class="btn btn-warning" id="btnNewEmployee">Nuevo Empleado</a>
    </div>

    <form method="post" action="empleados.php" class="d-flex">
      <div class="container" style="width: 30%;">
        <input type="search" name="txtBuscarEmpleado" class="form-control me-2" placeholder="Search" aria-label="Search" id="searchEmployee">
      </div>

      <div class="d-grid gap-2 d-md-block align-items-start p-2">
        <input type="submit" class="btn btn-outline-warning" name="btnBuscarEmpleado" value="Search" id="btnSearchEmployee">
        <input type="submit" class="btn btn-outline-warning" name="btnFiltrarEmpleado" value="Filter" id="btnFilterEmployee">
      </div>
    </form>

    <div class="col-xxl-10">
      <table class="table table-dark table-striped table-borderless">
        <thead>
          <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Cargo</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <?php $empleado->index(); ?>
        </tbody>
      </table>
    </div>

  </div>

</div>

<?php require '../include/footer.php'; ?>
