<?php 

require 'logica/Reserva.php';

$objReserva = new Reserva();
$objReserva->create($_POST['txtIdReserva'], $_POST['txtIdUsuario'], $_POST['txtIdLibro'], $_POST['txtIdEmpleado']);

if (isset($_POST['btnCancelarReserva'])) {
    header('Location: reservas.php');
}

?>

<?php require 'include/header.php' ?>

<div class="container p-4">

    <p class="h1">Create Reservation</p>

    <?php if (isset($_SESSION['message'])) { ?>
        <div class="alert alert-<?= $_SESSION['message_type']; ?> alert-dismissible fade show" role="alert">
                <?= $_SESSION['message'] ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php session_unset(); } ?>

    <div class="card card-body bg-dark">

        <form method="post" action="new_reserva.php" class="row row-cols-4">
            <div class="mb-3 col">
                <label class="col-sm-2 col-form-label">ID</label>
                <input type="text" name="txtIdReserva" class="form-control" autofocus>
            </div>
            <div class="mb-3 col">
                <label class="col-sm-4 col-form-label">ID User</label>
                <input type="text" name="txtIdUsuario" class="form-control">
            </div>
            <div class="mb-3 col">
                <label class="col-sm-4 col-form-label">ID Book</label>
                <input type="text" name="txtIdLibro" class="form-control">
            </div>
            <div class="mb-3 col">
                <label class="col-sm-6 col-form-label">ID Employee</label>
                <input type="text" name="txtIdEmpleado" class="form-control">
            </div>

            <div class="d-grid gap-2 d-md-block align-items-start p-2">
                <input type="submit" name="btnAgregarReserva" value="Create" class="btn btn-warning">
                <input type="submit" name="btnCancelarReserva" value="Cancel" class="btn btn-outline-secondary">
            </div>
        </form>

    </div>

</div>

<?php require 'include/footer.php' ?>
