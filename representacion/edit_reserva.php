<?php

require '../logica/Reserva.php';

$objReserva = new Reserva();

$objReserva->edit($_GET['id_reserva'], $_POST['txtIdUsuario'], $_POST['txtIdLibro'], $_POST['txtIdEmpleado']);
$objReserva->info($_GET['id_reserva']);
$objReserva->delete($_GET['id_reserva']);

if (isset($_POST['btnCancelarReserva'])) {
    header('Location: reservas.php');
}

?>

<?php require '../include/header.php'; ?>

<div class="container p-4">

    <p class="h1">Edit Reservation</p>

    <?php if (isset($_SESSION['message'])) { ?>
        <div class="alert alert-<?= $_SESSION['message_type']; ?> alert-dismissible fade show" role="alert">
            <?= $_SESSION['message']; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php session_unset(); } ?>

    <div class="card card-body bg-dark">
        <form method="post" action="edit_reserva.php?id_reserva=<?= $_GET['id_reserva']; ?>" class="row row-cols-4">
            <div class="mb-3 col">
                <label class="col-sm-3 col-form-label">ID User</label>
                <input type="text" name="txtIdUsuario" class="form-control" value="<?= $objReserva->getIdUsuario(); ?>">
            </div>
            <div class="mb-3 col">
                <label class="col-sm-3 col-form-label">ID Book</label>
                <input type="text" name="txtIdLibro" class="form-control" value="<?= $objReserva->getIdLibro(); ?>">
            </div>
            <div class="mb-3 col">
                <label class="col-sm-5 col-form-label">ID Employee</label>
                <input type="text" name="txtIdEmpleado" class="form-control" value="<?= $objReserva->getIdEmpleado(); ?>">
            </div>

            <div class="d-grid gap-2 d-md-block align-items-start p-2">
                <input type="submit" name="btnEditarReserva" value="Save changes" class="btn btn-warning">
                <input type="submit" name="btnCancelarReserva" value="Cancel" class="btn btn-outline-secondary" style="transform: translateY(-0%) translateX(0%);">
                <input type="submit" name="btnEliminarReserva" value="Delete" class="btn btn-danger" style="transform: translateY(-550%) translateX(1380%);" onclick="return confirm('Seguro que desea eliminar?')">
            </div>
        </form>

    </div>

</div>

<?php require '../include/footer.php'; ?>
