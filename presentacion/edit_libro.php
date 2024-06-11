<?php 

require '../logica-negocio/Libro.php';

$libro = new Libro();

$libro->edit($_GET['id_libro'], $_POST['txtTituloLibro'], $_POST['txtAutorLibro'], $_POST['txtCantidadLibro'], $_POST['txtCategoriaLibro']);
$libro->info($_GET['id_libro']);
$libro->delete($_GET['id_libro']);

if (isset($_POST['btnCancelarLibro'])) {
    header('Location: libros.php');
}

?>

<?php require '../include/header.php'; ?>

<div class="container p-4">

    <p class="h1">Editar Libro</p>

    <?php if (isset($_SESSION['message'])) { ?>
        <div class="alert alert-<?= $_SESSION['message_type']; ?> alert-dismissible fade show" role="alert">
            <?= $_SESSION['message']; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php session_unset(); } ?>

    <div class="card card-body bg-dark">
        <form method="post" action="edit_libro.php?id_libro=<?= $_GET['id_libro']; ?>" class="row row-cols-4">
            <div class="mb-3 col">
                <label class="col-sm-2 col-form-label">Titulo</label>
                <input type="text" name="txtTituloLibro" class="form-control" value="<?= $libro->getTitulo(); ?>">
            </div>
            <div class="mb-3 col">
                <label class="col-sm-4 col-form-label">Autor</label>
                <input type="text" name="txtAutorLibro" class="form-control" value="<?= $libro->getAutor(); ?>">
            </div>
            <div class="mb-3 col">
                <label class="col-sm-3 col-form-label">Stock</label>
                <input type="text" name="txtCantidadLibro" class="form-control" value="<?= $libro->getCantidad(); ?>">
            </div>
            <div class="mb-3 col">
                <label class="col-sm-5 col-form-label">Categoria</label>
                <input type="text" name="txtCategoriaLibro" class="form-control" value="<?= $libro->getCategoria(); ?>">
            </div>
        
            <div class="d-grid gap-2 d-md-block align-items-start p-2">
                <input type="submit" name="btnEditarLibro" value="Save changes" class="btn btn-warning">
                <input type="submit" name="btnCancelarLibro" value="Cancel" class="btn btn-outline-secondary">
                <input type="submit" name="btnEliminarLibro" value="Delete" class="btn btn-danger">
            </div>
        </form>
    </div>

</div>

<?php require '../include/footer.php'; ?>
