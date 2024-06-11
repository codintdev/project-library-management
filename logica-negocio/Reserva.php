<?php

require '../datos/Conexion.php';

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

    public function index() {

        try {
            parent::conexion();

            $query = "SELECT res.*, usu.*, lib.*, emp.* FROM reserva res INNER JOIN usuario usu ON res.id_usuario = usu.id_usuario INNER JOIN libro lib ON res.id_libro = lib.id_libro INNER JOIN empleado emp ON res.id_empleado = emp.id_empleado ORDER BY id_reserva ASC";
            $resultado = mysqli_query($this->conn, $query);

            if (!$resultado) {
                echo "Error de consulta hacia la base de datos! " . mysqli_errno($this->conn);
            }

            while ($row = mysqli_fetch_array($resultado)) {
                echo "
                <tr>
                    <td>" . $row['id_reserva'] . "</td>
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
            echo "Error al listar las reservas de la base de datos! " . $e->getMessage();
        }
    }

    public function create($id_usuario, $id_libro, $id_empleado) {

        try {
            parent::conexion();

            if (isset($_POST['btnAgregarReserva'])) {
                if (empty($_POST['txtIdReserva'])) {
                    echo '<script>alert("Debes llenar todos los campos"); window.location="new_reserva.php";</script>';
                }
    
                $validatorLibro = "SELECT cantidad FROM libro WHERE id_libro = ?";
                $stmt_validator = $this->conn->prepare($validatorLibro);
                $stmt_validator->bind_param("i", $id_libro);
                $resultado = $stmt_validator->execute();
                $resultado = $stmt_validator->get_result();

                if (!$resultado) {
                    echo "Error al listar la cantidad del libro! " . mysqli_errno($this->conn);
                }

                $row = mysqli_fetch_assoc($resultado);

                if ($row['cantidad'] > 0) {
                    $query = "INSERT INTO reserva VALUES (default, ?, ?, current_timestamp, ?)";
                    $stmt = $this->conn->prepare($query);
                    $stmt->bind_param("iii", $id_usuario, $id_libro, $id_empleado);
                    $resultado = $stmt->execute();
        
                    if (!$resultado) {
                        echo 'Error al crear la reserva! ' . mysqli_errno($this->conn);
                    }

                    $cantidadLibro = "UPDATE libro SET cantidad = cantidad - 1 WHERE id_libro = ?";
                    $stmt_cantidad = $this->conn->prepare($cantidadLibro);
                    $stmt_cantidad->bind_param("i", $id_libro);
                    $resultado = $stmt_cantidad->execute();

                    if (!$resultado) {
                        echo 'Error al actualizar la cantidad del libro! ' . mysqli_errno($this->conn);
                    }

                    $_SESSION['message'] = 'Created';
                    $_SESSION['message_type'] = 'success';
                }
                else {
                    echo '<script>alert("Error no hay stock! "); window.location="new_reserva.php"</script>';
                }
            }
    
            $this->conn->close();
        }
        catch (Exception $e) {
            $this->conn->close();
            echo "Error al crear la reserva de la base de datos! " . $e->getMessage();
        }
    }

    public function info($id_reserva) {

        try {
            parent::conexion();

            if (isset($_GET['id_reserva'])) {
                //$id = $_GET['id_reserva'];

                $query = "SELECT * FROM reserva WHERE id_reserva = $id_reserva";
                $result = mysqli_query($this->conn, $query);

                if (mysqli_num_rows($result) == 1) {
                    $row = mysqli_fetch_array($result);
                    //$this->setIdReserva($row['id_reserva']);
                    $this->setIdUsuario($row['id_usuario']);
                    $this->setIdLibro($row['id_libro']);
                    $this->setIdEmpleado($row['id_empleado']);
                }
            }
        }
        catch (Exception $e) {
            $this->conn->close();
            echo "Error no se encuentra el libro en la base de datos! " . $e->getMessage();
        }
    }

    public function edit($id_reserva, $id_usuario, $id_libro, $id_empleado) {

        try {
            parent::conexion();

            if (isset($_POST['btnEditarReserva'])) {
                if (empty($_POST['txtNombreReserva'])) {
                    echo '<script>alert("Debes llenar todos los campos"); window.location="edit_reserva.php";</script>';
                }

                $validatorLibro = "SELECT cantidad FROM libro WHERE id_libro = ?";
                $stmt_validator = $this->conn->prepare($validatorLibro);
                $stmt_validator->bind_param("i", $id_libro);
                $resultado = $stmt_validator->execute();
                $resultado = $stmt_validator->get_result();

                if (!$resultado) {
                    echo "Error al traer el cantidad de libros! " . mysqli_errno($this->conn);
                }

                $row = mysqli_fetch_assoc($resultado);

                if ($row['cantidad'] > 0) {
                    $query = "UPDATE reserva SET id_usuario = ?, id_libro = ?, fecha_reserva = current_timestamp, id_empleado = ? WHERE id_reserva = ?";
                    $stmt = $this->conn->prepare($query);
                    $stmt->bind_param("iiii", $id_usuario, $id_libro, $id_empleado, $id_reserva);
                    $resultado = $stmt->execute();

                    if (!$resultado) {
                        echo 'Error al actualizar la reserva! ' . mysqli_errno($this->conn);
                    }

                    $cantidadLibro = "UPDATE libro SET cantidad = cantidad - 1 WHERE id_libro = ?";
                    $stmt_cantidad = $this->conn->prepare($cantidadLibro);
                    $stmt_cantidad->bind_param("i", $id_libro);
                    $resultado = $stmt_cantidad->execute();

                    if (!$resultado) {
                        echo 'Error al actualizar la cantidad del libro! ' . mysqli_errno($this->conn);
                    }

                    $_SESSION['message'] = 'Saved';
                    $_SESSION['message_type'] = 'warning';
                }
            }

            $this->conn->close();
        }
        catch (Exception $e) {
            $this->conn->close();
            echo "Error al actualizar la reserva de la base de datos! " . $e->getMessage();
        }
    }

    public function delete($id_reserva) {

        try {
            parent::conexion();

            if (isset($_POST['btnEliminarReserva'])) {

                if (empty($_GET['id_reserva'])) {
                    echo '<script>alert("Debes llenar todos los campos"); window.location="edit_reserva.php";</script>';
                }
    
                $query_update = "UPDATE libro l INNER JOIN reserva r ON l.id_libro = r.id_libro set l.cantidad = l.cantidad + 1 WHERE r.id_reserva = ?";
                $stmt_update = $this->conn->prepare($query_update);
                $stmt_update->bind_param("i", $id_reserva);
                $result_update = $stmt_update->execute();

                if (!$result_update) {
                    echo "Error de consulta al actualizar la reserva! " . mysqli_errno($this->conn);
                }
    
                $query_delete = "DELETE FROM reserva WHERE id_reserva = ?";
                $stmt_delete = $this->conn->prepare($query_delete);
                $stmt_delete->bind_param("i", $id_reserva);
                $resultado_delete = $stmt_delete->execute();
    
                if (!$resultado_delete) {
                    echo 'Error al eliminar la reserva! ' . mysqli_errno($this->conn);
                }

                $_SESSION['message'] = 'Deleted';
                $_SESSION['message_type'] = 'danger';
            }
    
            $this->conn->close();
        }
        catch (Exception $e) {
            $this->conn->close();
            echo "Error al eliminar la reserva de la base de datos! " . $e->getMessage();
        }
    }
}

