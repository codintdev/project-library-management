<?php

require 'logica/Reserva.php';

$objReserva = new Reserva();

$objReserva->edit($_GET['id_reserva'], $_POST['txtIdUsuario'], $_POST['txtIdLibro'], $_POST['txtIdEmpleado']);
$objReserva->editReservation($_GET['id_reserva']);
$objReserva->delete($_GET['id_reserva']);

if (isset($_POST['btnCancelarReserva'])) {
    header('Location: reservas.php');
}

?>

<?php require 'include/header.php' ?>

<div class="container p-4">

    <p class="h1">Edit Reservation</p>

    <?php if (isset($_SESSION['message'])) { ?>
        <div class="alert alert-<?= $_SESSION['message_type']; ?> alert-dismissible fade show" role="alert">
                <?= $_SESSION['message'] ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php session_unset(); } ?>

    <div class="card card-body bg-dark">

        <form method="post" action="edit_reserva.php?id_reserva=<?php echo $_GET['id_reserva']; ?>" class="row row-cols-4">
            <div class="mb-3 col">
                <label class="col-sm-2 col-form-label">ID</label>
                <input type="text" name="txtIdReserva" class="form-control" value="<?php echo $objReserva->getIdReserva(); ?>" disabled>
            </div>
            <div class="mb-3 col">
                <label class="col-sm-3 col-form-label">ID User</label>
                <input type="text" name="txtIdUsuario" class="form-control" value="<?php echo $objReserva->getIdUsuario(); ?>">
            </div>
            <div class="mb-3 col">
                <label class="col-sm-3 col-form-label">ID Book</label>
                <input type="text" name="txtIdLibro" class="form-control" value="<?php echo $objReserva->getIdLibro(); ?>">
            </div>
            <div class="mb-3 col">
                <label class="col-sm-5 col-form-label">ID Employee</label>
                <input type="text" name="txtIdEmpleado" class="form-control" value="<?php echo $objReserva->getIdEmpleado(); ?>">
            </div>

            <div class="d-grid gap-2 d-md-block align-items-start p-2">
                <input type="submit" name="btnEditarReserva" value="Save changes" class="btn btn-warning">
                <input type="submit" name="btnEliminarReserva" value="Delete" class="btn btn-danger">
                <input type="submit" name="btnCancelarReserva" value="Cancel" class="btn btn-outline-secondary">
            </div>
        </form>

    </div>

</div>

<?php require 'include/footer.php' ?>
