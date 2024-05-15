<?php 

require 'logica/Empleado.php';

$objEmpleado = new Empleado();

$objEmpleado->create($_POST['txtIdEmpleado'], $_POST['txtNombreEmpleado'], $_POST['txtApellidoEmpleado'], $_POST['txtCargoEmpleado']);

if (isset($_POST['btnCancelarEmpleado'])) {
    header('Location: empleados.php');
}

?>

<?php require 'include/header.php' ?>

<div class="container p-4">

    <p class="h1">Create Employee</p>

    <?php if (isset($_SESSION['message'])) { ?>
        <div class="alert alert-<?= $_SESSION['message_type']; ?> alert-dismissible fade show" role="alert">
            <?= $_SESSION['message'] ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php session_unset(); } ?>

    <div class="card card-body bg-dark">

        <form method="post" action="new_empleado.php" class="row row-cols-4">
            <div class="mb-3 col">
                <label class="col-sm-2 col-form-label">ID</label>
                <input type="text" name="txtIdEmpleado" class="form-control">
            </div>
            <div class="mb-3 col">
                <label class="col-sm-3 col-form-label">Name</label>
                <input type="text" name="txtNombreEmpleado" class="form-control">
            </div>
            <div class="mb-3 col">
                <label class="col-sm-4 col-form-label">Lastname</label>
                <input type="text" name="txtApellidoEmpleado" class="form-control">
            </div>
            <div class="mb-3 col">
                <label class="col-sm-3 col-form-label">Charge</label>
                <input type="text" name="txtCargoEmpleado" class="form-control">
            </div>

            <div class="d-grid gap-2 d-md-block align-items-start p-2">
                <input type="submit" name="btnAgregarEmpleado" value="Create" class="btn btn-warning">
                <input type="submit" name="btnCancelarEmpleado" value="Cancel" class="btn btn-outline-secondary">
            </div>
        </form>

    </div>

</div>

<?php require 'include/footer.php' ?>

