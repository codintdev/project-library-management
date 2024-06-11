<?php

require '../logica-negocio/Empleado.php';

$empleado = new Empleado();
$empleado->edit($_GET['id_empleado'], $_POST['txtNombreEmpleado'], $_POST['txtApellidoEmpleado'], $_POST['txtCargoEmpleado']);
$empleado->info($_GET['id_empleado']);
$empleado->delete($_GET['id_empleado']);

if (isset($_POST['btnCancelarEmpleado'])) {
    header('Location: empleados.php');
}

?>

<?php require '../include/header.php'; ?>

<div class="container p-4">

    <p class="h1">Editar Empleado</p>

    <?php if (isset($_SESSION['message'])) { ?>
        <div class="alert alert-<?= $_SESSION['message_type']; ?> alert-dismissible fade show" role="alert" style="width: 20%;">
            <?= $_SESSION['message']; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php session_unset(); } ?>

    <div class="card card-body bg-dark">
        <form method="post" action="edit_empleado.php?id_empleado=<?= $_GET['id_empleado']; ?>" class="row row-cols-3">
            <div class="mb-3 col">
                <label class="col-sm-3 col-form-label">Nombre</label>
                <input type="text" name="txtNombreEmpleado" class="form-control" value="<?= $empleado->getNombre(); ?>">
            </div>
            <div class="mb-3 col">
                <label class="col-sm-4 col-form-label">Apellido</label>
                <input type="text" name="txtApellidoEmpleado" class="form-control" value="<?= $empleado->getApellido(); ?>">
            </div>
            <div class="mb-3 col">
                <label class="col-sm-3 col-form-label">Cargo</label>
                <input type="text" name="txtCargoEmpleado" class="form-control" value="<?= $empleado->getCargo(); ?>">
            </div>

            <div class="d-grid gap-2 d-md-block align-items-start p-2">
                <input type="submit" name="btnActualizarEmpleado" value="Save changes" class="btn btn-warning">
                <input type="submit" name="btnCancelarEmpleado" value="Cancel" class="btn btn-outline-secondary">
                <input type="submit" name="btnEliminarEmpleado" value="Delete" class="btn btn-danger" onclick="return confirm('Seguro desea eliminar?')">
            </div>
        </form>
    </div>

</div>

<?php require '../include/footer.php' ?>


