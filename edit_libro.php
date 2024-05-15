<?php 

require 'logica/Libro.php';

$objLibro = new Libro();

$objLibro->edit($_GET['id_libro'], $_POST['txtTituloLibro'], $_POST['txtAutorLibro'], $_POST['txtCantidadLibro'], $_POST['txtCategoriaLibro']);
$objLibro->editBook($_GET['id_libro']);
$objLibro->delete($_GET['id_libro']);
$objLibro->changeCategory($_GET['id_libro'], $_POST['txtCategoriaLibro']);

if (isset($_POST['btnCancelarLibro'])) {
    header('Location: libros.php');
}

?>

<?php require 'include/header.php' ?>

<div class="container p-4">

    <p class="h1">Edit Book</p>

    <?php if (isset($_SESSION['message'])) { ?>
        <div class="alert alert-<?= $_SESSION['message_type']; ?> alert-dismissible fade show" role="alert">
                <?= $_SESSION['message'] ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php session_unset(); } ?>

    <div class="card card-body bg-dark">

        <form method="post" action="edit_libro.php?id_libro=<?php echo $_GET['id_libro']; ?>" class="row row-cols-5">
            <div class="mb-3 col">
                <label class="col-sm-2 col-form-label">ID</label>
                <input type="text" name="txtIdLibro" class="form-control" value="<?php echo $objLibro->getId(); ?>" disabled>
            </div>
            <div class="mb-3 col">
                <label class="col-sm-2 col-form-label">Title</label>
                <input type="text" name="txtTituloLibro" class="form-control" value="<?php echo $objLibro->getTitulo(); ?>">
            </div>
            <div class="mb-3 col">
                <label class="col-sm-4 col-form-label">Author</label>
                <input type="text" name="txtAutorLibro" class="form-control" value="<?php echo $objLibro->getAutor(); ?>">
            </div>
            <div class="mb-3 col">
                <label class="col-sm-3 col-form-label">Stock</label>
                <input type="text" name="txtCantidadLibro" class="form-control" value="<?php echo $objLibro->getCantidad(); ?>">
            </div>
            <div class="mb-3 col">
                <label class="col-sm-5 col-form-label">Category</label>
                <input type="text" name="txtCategoriaLibro" class="form-control" value="<?php echo $objLibro->getCategoria(); ?>">
            </div>
        

            <div class="d-grid gap-2 d-md-block align-items-start p-2">
                <input type="submit" name="btnEditarLibro" value="Save changes" class="btn btn-warning">
                <input type="submit" name="btnEliminarLibro" value="Delete" class="btn btn-danger">
                <input type="submit" name="btnCancelarLibro" value="Cancel" class="btn btn-outline-secondary">
            </div>
        </form>
      
    </div>

</div>

<?php require 'include/footer.php' ?>
