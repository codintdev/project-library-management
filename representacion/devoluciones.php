<?php

require '../logica/Devolucion.php';

$objDevolucion = new Devolucion();

?>

<?php require '../include/header.php'; ?>

<div class="container text-center p-4">

  <div class="row">

    <div class="col-auto">
      <p class="h1">Returns</p>
    </div>

    <div class="col-md-8">
      <a href="new_devolucion.php" class="btn btn-warning" style="transform: translateX(270%);">New Devolucion</a>
    </div>

    <div class="col-xxl-8">
      <table class="table table-dark table-striped table-borderless">
        <thead>
          <tr>
            <th>ID</th>
            <th>Date</th>
            <th>Days Loan</th>
            <th>Title</th>
            <th>Author</th>
            <th>Stock</th>
            <th>Category</th>
            <th>Name User</th>
            <th>Lastname</th>
            <th>Address</th>
            <th>Phone</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <?php $objDevolucion->index(); ?>
        </tbody>
      </table>
    </div>

  </div>

</div>

<?php require '../include/footer.php'; ?>
