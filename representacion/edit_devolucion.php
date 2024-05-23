<?php

require '../logica/Devolucion.php';

$objDevolucion = new Devolucion();
$objDevolucion->edit($_POST['txtDiasPrestamo'], $_POST['txtIdLibro'], $_POST['txtIdUsuario']);
$objDevolucion->info($_GET['id_devolucion']);
$objDevolucion->delete($_GET['id_devolucion']);

if (isset($_POST['btnCancelarDevolucion'])) {
    header('Location: devoluciones.php');
}

?>

<?php require '../include/header.php'; ?>

<div class="container p-4">

    <p class="h1">Edit Return</p>

    <?php if (isset($_SESSION['message'])) { ?>
        <div class="alert alert-<?= $_SESSION['message_type']; ?> alert-dismissible fade show" role="alert" style="width: 20%;">
            <?= $_SESSION['message'] ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php session_unset(); } ?>

    <div class="card card-body bg-dark">
        <form method="post" action="edit_devolucion.php?id_devolucion=<?= $_GET['id_devolucion']; ?>" class="row row-cols-4">
            <div class="mb-3 col">
                <label class="col-sm-2 col-form-label">ID</label>
                <input type="text" name="txtIdDevolucion" class="form-control" value="<?= $objDevolucion->getId(); ?>" disabled>
            </div>
            <div class="mb-3 col">
                <label class="col-sm-6 col-form-label">Dias prestamo</label>
                <input type="text" name="txtDiasPrestamo" class="form-control" value="<?= $objDevolucion->getDiasPrestamo(); ?>">
            </div>
            <div class="mb-3 col">
                <label class="col-sm-3 col-form-label">ID libro</label>
                <input type="text" name="txtIdLibro" class="form-control" value="<?= $objDevolucion->getIdLibro(); ?>">
            </div>
            <div class="mb-3 col">
                <label class="col-sm-4 col-form-label">ID usuario</label>
                <input type="text" name="txtIdUsuario" class="form-control" value="<?= $objDevolucion->getIdUsuario(); ?>">
            </div>
          
            <div class="d-grid gap-2 d-md-block align-items-start p-2">
                <input type="submit" name="btnEditarDevolucion" value="Save changes" class="btn btn-warning">
                <input type="submit" name="btnCancelarDevolucion" value="Cancel" class="btn btn-outline-secondary" style="transform: translateY(0%) translateX(0%);">
                <input type="submit" name="btnEliminarDevolucion" value="Delete" class="btn btn-danger" style="transform: translateY(-550%) translateX(1390%);" onclick="return confirm('Seguro que desea eliminar?')">
            </div>
        </form>
      </div>

</div>

<?php require '../include/footer.php'; ?>
