<?php

require 'logica/Prestamo.php';

$objPrestamo = new Prestamo();

$objPrestamo->edit($_GET['id_prestamo'], $_POST['txtIdUsuario'], $_POST['txtIdLibro'], $_POST['txtDiasPrestamo'], $_POST['txtIdEmpleado']);
$objPrestamo->delete($_GET['id_prestamo']);
$objPrestamo->editLoan($_GET['id_prestamo']);

if (isset($_POST['btnCancelarPrestamo'])) {
    header('Location: prestamos.php');
}

?>

<?php require 'include/header.php' ?>

<div class="container p-4">

    <p class="h1">Edit Loan</p>

        <?php if (isset($_SESSION['message'])) { ?>
            <div class="alert alert-<?= $_SESSION['message_type']; ?> alert-dismissible fade show" role="alert">
                <?= $_SESSION['message'] ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php session_unset(); } ?>

      <div class="card card-body bg-dark">

        <form method="post" action="edit_prestamo.php?id_prestamo=<?php echo $_GET['id_prestamo']; ?>" class="row row-cols-5">
            <div class="mb-3 col">
                <label class="col-sm-2 col-form-label">ID</label>
                <input type="text" name="txtIdPrestamo" class="form-control" value="<?php echo $objPrestamo->getIdPrestamo(); ?>" disabled>
            </div>
            <div class="mb-3 col">
                <label class="col-sm-4 col-form-label">ID User</label>
                <input type="text" name="txtIdUsuario" class="form-control" value="<?php echo $objPrestamo->getIdUsuario(); ?>">
            </div>
            <div class="mb-3 col">
                <label class="col-sm-4 col-form-label">ID Book</label>
                <input type="text" name="txtIdLibro" class="form-control" value="<?php echo $objPrestamo->getIdLibro(); ?>">
            </div>
            <div class="mb-3 col">
                <label class="col-sm-5 col-form-label">Days loans</label>
                <input type="text" name="txtDiasPrestamo" class="form-control" value="<?php echo $objPrestamo->getDiasPrestamo(); ?>">
            </div>
            <div class="mb-3 col">
                <label class="col-sm-6 col-form-label">ID employee</label>
                <input type="text" name="txtIdEmpleado" class="form-control" value="<?php echo $objPrestamo->getIdEmpleado(); ?>">
            </div>
          
            <div class="d-grid gap-2 d-md-block align-items-start p-2">
                <input type="submit" name="btnEditarPrestamo" value="Save changes" class="btn btn-warning">
                <input type="submit" name="btnEliminarPrestamo" value="Delete" class="btn btn-danger">
                <input type="submit" name="btnCancelarPrestamo" value="Cancel" class="btn btn-outline-secondary">
            </div>
        </form>

      </div>

</div>

<?php require 'include/footer.php' ?>
