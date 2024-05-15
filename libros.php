<?php

require 'logica/Libro.php';

$objLibro = new Libro();

?>

<?php require 'include/header.php'; ?>

<div class="container text-center p-4">

  <div class="row">

    <div class="col-auto">
      <p class="h1">Books</p>
    </div>

    <div class="col-md-8">
      <p><a href="new_libro.php" class="btn btn-warning">New Book</a></p>
    </div>

    <div class="col-xxl-8">

      <table class="table table-dark table-striped table-borderless">
        <thead>
          <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Author</th>
            <th>Stock</th>
            <th>Category</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <?php 
          $objLibro->index();
          ?>
        </tbody>
      </table>

    </div>

  </div>

</div>

<?php require 'include/footer.php'; ?>
