<?php

require 'datos/Conexion.php';

class Reserva extends Conexion {

    protected $id_reserva;
    protected $id_usuario;
    protected $id_libro;
    protected $id_empleado;

    public function setIdReserva($id_reserva) {
        $this->id_reserva = $id_reserva;
    }
    public function setIdUsuario($id_usuario) {
        $this->id_usuario = $id_usuario;
    }
    public function setIdLibro($id_libro) {
        $this->id_libro = $id_libro;
    }
    public function setIdEmpleado($id_empleado) {
        $this->id_empleado = $id_empleado;
    }

    public function getIdReserva() {
        return $this->id_reserva;
    }
    public function getIdUsuario() {
        return $this->id_usuario;
    }
    public function getIdLibro() {
        return $this->id_libro;
    }
    public function getIdEmpleado() {
        return $this->id_empleado;
    }

    public function create($id_reserva, $id_usuario, $id_libro, $id_empleado) {

        try {
            parent::conexion();

            if (isset($_POST['btnAgregarReserva'])) {

                if (empty($_POST['txtIdReserva'])) {
                    echo '<script>alert("Debes llenar todos los campos"); window.location="reservas.php";</script>';
                }
    
                $validatorLibro = "select cantidad from libro where id_libro = ?";
                $stmt_validator = $this->conn->prepare($validatorLibro);
                $stmt_validator->bind_param("i", $id_libro);
                $resultado = $stmt_validator->execute();
                $resultado = $stmt_validator->get_result();

                $row = mysqli_fetch_assoc($resultado);

                if ($row['cantidad'] > 0) {
                    $query = "insert into reserva values (?, ?, ?, current_timestamp, ?)";
                    $stmt = $this->conn->prepare($query);
                    $stmt->bind_param("iiii", $id_reserva, $id_usuario, $id_libro, $id_empleado);
                    $resultado = $stmt->execute();
        
                    if (!$resultado) {
                        echo '<script>alert("!Error al crear la reserva"); window.location="reservas.php"</script>';
                    }

                    $cantidadLibro = "update libro set cantidad = cantidad - 1 where id_libro = ?";
                    $stmt_cantidad = $this->conn->prepare($cantidadLibro);
                    $stmt_cantidad->bind_param("i", $id_libro);
                    $resultado = $stmt_cantidad->execute();

                    if (!$resultado) {
                        echo '<script>alert("!Error al actualizar la cantidad del libro"); window.location="reservas.php"</script>' . $resultado->Error();
                    }

                    $_SESSION['message'] = 'Created';
                    $_SESSION['message_type'] = 'success';
        
                    header("Location: reservas.php");
                }
                else {
                    echo '<script>alert("!Error no hay stock"); window.location="reservas.php"</script>';
                }
            }
    
            $this->conn->close();
        }
        catch (Exception $e) {
            $this->conn->close();
            echo "!Error al crear la reserva de la base de datos. " . $e->getMessage();
        }
    }

    public function index() {

        try {
            parent::conexion();

            $query = "select res.*, usu.*, lib.*, emp.* from reserva res inner join usuario usu on res.id_usuario = usu.id_usuario inner join libro lib on res.id_libro = lib.id_libro inner join empleado emp on res.id_empleado = emp.id_empleado order by id_reserva asc";
            $resultado = mysqli_query($this->conn, $query);

            while ($row = mysqli_fetch_array($resultado)) {

                echo "
                <tr>
                    <td>" . $row['id_reserva'] . "</td>
                    <td>" . $row['id_usuario'] . "</td>
                    <td>" . $row['nombre_usuario'] . "</td>
                    <td>" . $row['apellido_usuario'] . "</td>
                    <td>" . $row['direccion'] . "</td>
                    <td>" . $row['telefono'] . "</td>
                    <td>" . $row['titulo'] . "</td>
                    <td>" . $row['autor'] . "</td>
                    <td>" . $row['cantidad'] . "</td>
                    <td>" . $row['categoria'] . "</td>
                    <td>" . $row['fecha_reserva'] . "</td>
                    <td>
                        <a href='edit_reserva.php?id_reserva=" . $row['id_reserva'] . "' class='link-warning link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover'>Edit</a>
                    </td>
                </tr>
                ";
            }

            $this->conn->close();
        }
        catch (Exception $e) {
            $this->conn->close();
            echo "!Error al listar las reservas de la base de datos. " . $e->getMessage();
        }
    }

    public function edit($id_reserva, $id_usuario, $id_libro, $id_empleado) {

        try {
            parent::conexion();

            if (isset($_POST['btnEditarReserva'])) {

                if (empty($_POST['txtIdReserva'])) {
                    echo '<script>alert("Debes llenar todos los campos"); window.location="reservas.php";</script>';
                }

                $validatorLibro = "select cantidad from libro where id_libro = ?";
                $stmt_validator = $this->conn->prepare($validatorLibro);
                $stmt_validator->bind_param("i", $id_libro);
                $resultado = $stmt_validator->execute();
                $resultado = $stmt_validator->get_result();

                $row = mysqli_fetch_assoc($resultado);

                if ($row['cantidad'] > 0) {
                    $query = "update reserva set id_usuario = ?, id_libro = ?, fecha_reserva = current_timestamp, id_empleado = ? where id_reserva = ?";
                    $stmt = $this->conn->prepare($query);
                    $stmt->bind_param("iiii", $id_usuario, $id_libro, $id_empleado, $id_reserva);
                    $resultado = $stmt->execute();

                    if (!$resultado) {
                        echo '<script>alert("!Error al actualizar la reserva"); window.location="reservas.php"</script>' . $resultado->Error();
                    }

                    $cantidadLibro = "update libro set cantidad = cantidad - 1 where id_libro = ?";
                    $stmt_cantidad = $this->conn->prepare($cantidadLibro);
                    $stmt_cantidad->bind_param("i", $id_libro);
                    $resultado = $stmt_cantidad->execute();

                    if (!$resultado) {
                        echo '<script>alert("!Error al actualizar la cantidad del libro"); window.location="reservas.php"</script>' . $resultado->Error();
                    }

                    $_SESSION['message'] = 'Saved';
                    $_SESSION['message_type'] = 'success';

                    header("Location: reservas.php");
                }
            }

            $this->conn->close();
        }
        catch (Exception $e) {
            $this->conn->close();
            echo "!Error al actualizar la reserva de la base de datos. " . $e->getMessage();
        }
    }

    public function delete($id_reserva) {

        try {
            parent::conexion();

            if (isset($_POST['btnEliminarReserva'])) {

                if (empty($_GET['id_reserva'])) {
                    echo '<script>alert("Debes llenar todos los campos"); window.location="reservas.php";</script>';
                }
    
                $query_update = "update libro l inner join reserva r on l.id_libro = r.id_libro set l.cantidad = l.cantidad + 1 where r.id_reserva = ?";
                $stmt_update = $this->conn->prepare($query_update);
                $stmt_update->bind_param("i", $_GET['id_reserva']);
                $result_update = $stmt_update->execute();

                if (!$result_update) {
                    echo "Error de consulta al actualizar la reserva";
                }
    
                $query_delete = "delete from reserva where id_reserva = ?";
                $stmt_delete = $this->conn->prepare($query_delete);
                $stmt_delete->bind_param("i", $_GET['id_reserva']);
                $resultado_delete = $stmt_delete->execute();
    
                if (!$resultado_delete) {
                    echo '<script>alert("!Error al eliminar la reserva"); window.location="reservas.php"</script>';
                }

                $_SESSION['message'] = 'Deleted';
                $_SESSION['message_type'] = 'success';
    
                header("Location: reservas.php");
            }
    
            $this->conn->close();
        }
        catch (Exception $e) {
            $this->conn->close();
            echo "!Error al eliminar la reserva de la base de datos. " . $e->getMessage();
        }
    }

    public function editReservation($id_reserva) {

        try {
            parent::conexion();

            if (isset($_GET['id_reserva'])) {
                $id = $_GET['id_reserva'];
                $query = "select * from reserva where id_reserva = $id";
                $result = mysqli_query($this->conn, $query);

                if (mysqli_num_rows($result) == 1) {
                    $row = mysqli_fetch_array($result);
                    $this->setIdReserva($row['id_reserva']);
                    $this->setIdUsuario($row['id_usuario']);
                    $this->setIdLibro($row['id_libro']);
                    $this->setIdEmpleado($row['id_empleado']);
                }
            }
        }
        catch (Exception $e) {
            $this->conn->close();
            echo "!Error no se encuentra el libro en la base de datos. " . $e->getMessage();
        }
    }
}

