<?php

require '../logica-negocio/Libro.php';

$libro = new Libro();

?>

<?php require '../include/header.php'; ?>

<div class="container text-center p-4">

  <div class="row">

    <div class="col-auto">
      <p class="h1">Libros</p>
    </div>

    <div class="col-md-8">
      <a href="new_libro.php" class="btn btn-warning">Nuevo Libro</a>
    </div>

    <form method="post" action="libros.php" class="d-flex">
      <div class="container" style="width: 30%;">
        <input type="search" name="txtBuscarLibro" class="form-control me-2" placeholder="Search" aria-label="Search">
      </div>

      <div class="d-grid gap-2 d-md-block align-items-start p-2">
        <input type="submit" class="btn btn-outline-warning" name="btnBuscarLibro" value="Search">
        <input type="submit" class="btn btn-outline-warning" name="btnFiltrarCategoria" value="Filter Category">
      </div>
    </form>

    <div class="col-xxl-12">
      <table class="table table-dark table-striped table-borderless">
        <thead>
          <tr>
            <th>ID</th>
            <th>Titulo</th>
            <th>Autor</th>
            <th>Stock</th>
            <th>Categoria</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <?php $libro->index(); ?>
        </tbody>
      </table>
    </div>

  </div>

</div>

<?php require '../include/footer.php'; ?>
