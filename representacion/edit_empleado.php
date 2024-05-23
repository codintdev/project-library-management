<?php

require '../logica/Empleado.php';

$objEmpleado = new Empleado();

$objEmpleado->edit($_GET['id_empleado'], $_POST['txtNombreEmpleado'], $_POST['txtApellidoEmpleado'], $_POST['txtCargoEmpleado']);
$objEmpleado->info($_GET['id_empleado']);
$objEmpleado->delete($_GET['id_empleado']);

if (isset($_POST['btnCancelarEmpleado'])) {
    header('Location: empleados.php');
}

?>

<?php require '../include/header.php'; ?>

<div class="container p-4">

    <p class="h1">Edit Employee</p>

    <?php if (isset($_SESSION['message'])) { ?>
        <div class="alert alert-<?= $_SESSION['message_type']; ?> alert-dismissible fade show" role="alert" style="width: 20%;">
            <?= $_SESSION['message']; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php session_unset(); } ?>

    <div class="card card-body bg-dark">
        <form method="post" action="edit_empleado.php?id_empleado=<?= $_GET['id_empleado']; ?>" class="row row-cols-3">
            <div class="mb-3 col">
                <label class="col-sm-3 col-form-label">Name</label>
                <input type="text" name="txtNombreEmpleado" class="form-control" value="<?= $objEmpleado->getNombre(); ?>">
            </div>
            <div class="mb-3 col">
                <label class="col-sm-4 col-form-label">Lastname</label>
                <input type="text" name="txtApellidoEmpleado" class="form-control" value="<?= $objEmpleado->getApellido(); ?>">
            </div>
            <div class="mb-3 col">
                <label class="col-sm-3 col-form-label">Charge</label>
                <input type="text" name="txtCargoEmpleado" class="form-control" value="<?= $objEmpleado->getCargo(); ?>">
            </div>

            <div class="d-grid gap-2 d-md-block align-items-start p-2">
                <input type="submit" name="btnActualizarEmpleado" value="Save changes" class="btn btn-warning">
                <input type="submit" name="btnCancelarEmpleado" value="Cancel" class="btn btn-outline-secondary">
                <input type="submit" name="btnEliminarEmpleado" value="Delete" class="btn btn-danger" style="transform: translateY(-450%) translateX(1100%);" onclick="return confirm('Seguro desea eliminar?')">
            </div>
        </form>
    </div>

</div>

<?php require '../include/footer.php' ?>


