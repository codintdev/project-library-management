<?php 

require '../logica/Libro.php';

$objLibro = new Libro();

$objLibro->edit($_GET['id_libro'], $_POST['txtTituloLibro'], $_POST['txtAutorLibro'], $_POST['txtCantidadLibro'], $_POST['txtCategoriaLibro']);
$objLibro->info($_GET['id_libro']);
$objLibro->delete($_GET['id_libro']);

if (isset($_POST['btnCancelarLibro'])) {
    header('Location: libros.php');
}

?>

<?php require '../include/header.php'; ?>

<div class="container p-4">

    <p class="h1">Edit Book</p>

    <?php if (isset($_SESSION['message'])) { ?>
        <div class="alert alert-<?= $_SESSION['message_type']; ?> alert-dismissible fade show" role="alert">
            <?= $_SESSION['message']; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php session_unset(); } ?>

    <div class="card card-body bg-dark">
        <form method="post" action="edit_libro.php?id_libro=<?= $_GET['id_libro']; ?>" class="row row-cols-4">
            <div class="mb-3 col">
                <label class="col-sm-2 col-form-label">Title</label>
                <input type="text" name="txtTituloLibro" class="form-control" value="<?= $objLibro->getTitulo(); ?>">
            </div>
            <div class="mb-3 col">
                <label class="col-sm-4 col-form-label">Author</label>
                <input type="text" name="txtAutorLibro" class="form-control" value="<?= $objLibro->getAutor(); ?>">
            </div>
            <div class="mb-3 col">
                <label class="col-sm-3 col-form-label">Stock</label>
                <input type="text" name="txtCantidadLibro" class="form-control" value="<?= $objLibro->getCantidad(); ?>">
            </div>
            <div class="mb-3 col">
                <label class="col-sm-5 col-form-label">Category</label>
                <input type="text" name="txtCategoriaLibro" class="form-control" value="<?= $objLibro->getCategoria(); ?>">
            </div>
        
            <div class="d-grid gap-2 d-md-block align-items-start p-2">
                <input type="submit" name="btnEditarLibro" value="Save changes" class="btn btn-warning">
                <input type="submit" name="btnCancelarLibro" value="Cancel" class="btn btn-outline-secondary" style="transform: translateY(0%) translateX(0%);">
                <input type="submit" name="btnEliminarLibro" value="Delete" class="btn btn-danger" style="transform: translateY(-550%) translateX(1380%);">
            </div>
        </form>
    </div>

</div>

<?php require '../include/footer.php'; ?>
