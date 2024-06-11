<?php

require '../logica-negocio/Libro.php';

$objLibro = new Libro();

$objLibro->create($_POST['txtTituloLibro'], $_POST['txtAutorLibro'], $_POST['txtCantidadLibro'], $_POST['txtCategoriaLibro']);

if (isset($_POST['btnCancelarLibro'])) {
    header('Location: libros.php');
}

?>

<?php require '../include/header.php'; ?>

<div class="container p-4">

    <p class="h1">Create Book</p>

    <?php if (isset($_SESSION['message'])) { ?>
        <div class="alert alert-<?= $_SESSION['message_type']; ?> alert-dismissible fade show" role="alert">
            <?= $_SESSION['message']; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php session_unset(); } ?>

    <div class="card card-body bg-dark">
        <form method="post" action="new_libro.php" class="row row-cols-4">
            <div class="mb-3 col">
                <label class="col-sm-2 col-form-label">Title</label>
                <input type="text" name="txtTituloLibro" class="form-control">
            </div>
            <div class="mb-3 col">
                <label class="col-sm-4 col-form-label">Author</label>
                <input type="text" name="txtAutorLibro" class="form-control">
            </div>
            <div class="mb-3 col">
                <label class="col-sm-3 col-form-label">Stock</label>
                <input type="text" name="txtCantidadLibro" class="form-control">
            </div>
            <div class="mb-3 col">
                <label class="col-sm-5 col-form-label">Category</label>
                <input type="text" name="txtCategoriaLibro" class="form-control">
            </div>

            <div class="d-grid gap-2 d-md-block align-items-start p-2">
                <input type="submit" name="btnAgregarLibro" value="Create" class="btn btn-warning">
                <input type="submit" name="btnCancelarLibro" value="Cancel" class="btn btn-outline-secondary">
            </div>
        </form>
    </div>

</div>

<?php require '../include/footer.php' ?>
