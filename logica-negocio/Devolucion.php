<?php

require '../datos/Conexion.php';

class Devolucion extends Conexion {

    protected $id_devolucion;
    protected $fecha;
    protected $dias_prestamo;
    protected $id_libro;
    protected $id_usuario;

    public function setId($id_devolucion) {
        $this->id_devolucion = $id_devolucion;
    }
    public function setFecha($fecha) {
        $this->fecha = $fecha;
    }
    public function setDiasPrestamo($dias_prestamo) {
        $this->dias_prestamo = $dias_prestamo;
    }
    public function setIdLibro($id_libro) {
        $this->id_libro = $id_libro;
    }
    public function setIdUsuario($id_usuario) {
        $this->id_usuario = $id_usuario;
    }

    public function getId() {
        return $this->id_devolucion;
    }
    public function getFecha() {
        return $this->fecha;
    }
    public function getDiasPrestamo() {
        return $this->dias_prestamo;
    }
    public function getIdLibro() {
        return $this->id_libro;
    }
    public function getIdUsuario() {
        return $this->id_usuario;
    }

    // Mostrar las devoluciones
    public function index() {
        
        try {
            parent::conexion();

            $query = "SELECT d.*, l.*, u.* FROM devolucion d INNER JOIN libro l ON d.id_libro = l.id_libro INNER JOIN usuario u ON d.id_usuario = u.id_usuario ORDER BY id_devolucion ASC";
            $resultado = mysqli_query($this->conn, $query);

            if (!$resultado) {
                echo "Error en la query SELECT hacia la base de datos! " . mysqli_errno($this->conn);
            }

            while ($row = mysqli_fetch_array($resultado)) {
                echo "
                <tr>
                    <td>" . $row['id_devolucion'] . "</td>
                    <td>" . $row['fecha'] . "</td>
                    <td>" . $row['dias_prestamo'] . "</td>
                    <td>" . $row['titulo'] . "</td>
                    <td>" . $row['autor'] . "</td>
                    <td>" . $row['cantidad'] . "</td>
                    <td>" . $row['categoria'] . "</td>
                    <td>" . $row['nombre_usuario'] . "</td>
                    <td>" . $row['apellido_usuario'] . "</td>
                    <td>" . $row['direccion'] . "</td>
                    <td>" . $row['telefono'] . "</td>
                    <td>
                        <a href='edit_devolucion.php?id_devolucion=" . $row['id_devolucion'] . "' class='link-warning link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover'>Edit</a>
                    </td>
                </tr>
                ";
            }

            $this->conn->close();
        }
        catch (Exception $e) {
            $this->conn->close();
            echo 'Error en la función Index() hacia la base de datos! ' . $e->getMessage();
        }
    }

    public function create($dias_prestamo, $id_libro, $id_usuario) {

        try {
            parent::conexion();

            if (isset($_POST['btnAgregarDevolucion'])) {
                if (empty($_POST['txtIdLibro'])) {
                    echo '<script>alert("Debes llenar todos los campos! "); window.location="new_devolucion.php"</script>';
                }

                $query = "INSERT INTO devolucion VALUES (default, current_timestamp, ?, ?, ?)";
                $stmt = $this->conn->prepare($query);
                $stmt->bind_param("iii", $dias_prestamo, $id_libro, $id_usuario);
                $result = $stmt->execute();

                if (!$result) {
                    echo "Error en la query INSERT la devolución! " . mysqli_errno($this->conn);
                }

                $devolverLibro = "UPDATE libro SET cantidad = cantidad + 1 WHERE id_libro = ?";
                $stmt_sumar = $this->conn->prepare($devolverLibro);
                $stmt_sumar->bind_param("i", $id_libro);
                $result_sumar = $stmt_sumar->execute();

                if (!$result_sumar) {
                    echo 'Error al actualizar la cantidad del libro ! ' . mysqli_errno($this->conn);
                }

                $validarMultas = "SELECT multa FROM usuario WHERE id_usuario = ?";
                $stmt_validator = $this->conn->prepare($validarMultas);
                $stmt_validator->bind_param("i", $id_usuario);
                $result_validator = $stmt_validator->execute();
                $result_validator = $stmt_validator->get_result();

                if (!$result_validator) {
                    echo 'Error al traer la multa del usuario! ' . mysqli_errno($this->conn);
                }

                $row = mysqli_fetch_assoc($result_validator);

                $multa = $row['multa'] + 10000;

                if ($dias_prestamo >= 7) {
                    $query_multa = "UPDATE usuario SET multa = ? WHERE id_usuario = ?";
                    $stmt_multa = $this->conn->prepare($query_multa);
                    $stmt_multa->bind_param("ii", $multa, $id_usuario);
                    $result_multa = $stmt_multa->execute();

                    if (!$result_multa) {
                        echo 'Error al actualizar la multa del usuario! ' . mysqli_errno($this->conn);
                    }

                    echo '<script>alert("Usted ha recibido una multa de 10000 por los días de prestamo del libro"); window.location="edit_devolucion.php";</script>';
                }

                $_SESSION['message'] = 'Created';
                $_SESSION['message_type'] = 'success';
            }

            $this->conn->close();
        }
        catch(Exception $e) {
            $this->conn->close();
            echo "Error en la función Create hacia la base de datos! " . $e->getMessage();
        }
    }

    public function info($id_devolucion) {

        try {
            parent::conexion();

            if (isset($_GET['id_devolucion'])) {
                //$id = $_GET['id_devolucion'];

                $query = "SELECT * FROM devolucion WHERE id_devolucion = $id_devolucion";
                $result = mysqli_query($this->conn, $query);

                if (!$result) {
                    echo 'Error al traer la devolucion! ' . mysqli_errno($this->conn);
                }

                if (mysqli_num_rows($result) == 1) {
                    $row = mysqli_fetch_array($result);
                    //$this->setId($row['id_devolucion']);
                    $this->setFecha($row['fecha']);
                    $this->setDiasPrestamo($row['dias_prestamo']);
                    $this->setIdLibro($row['id_libro']);
                    $this->setIdUsuario($row[4]);
                }
            }

            $this->conn->close();
        }
        catch (Exception $e) {
            $this->conn->close();
            echo "Error en la función Info hacia la base de datos! " . $e->getMessage();
        }
    }

    public function edit($dias_prestamo, $id_libro, $id_usuario) {

        try {
            parent::conexion();

            if (isset($_POST['btnEditarDevolucion'])) {
                if (empty($_POST['txtIdLibro'])) {
                    echo '<script>alert("Debes llenar todos los campos"); window.location="edit_devolucion.php";</script>';
                }

                //$query = "update devolucion set"
            }

            $this->conn->close();
        }
        catch(Exception $e) {
            $this->conn->close();
            echo "Error en la función Edit() base de datos! " . $e->getMessage();
        }
    }

    public function delete($id_devolucion) {

        try {
            parent::conexion();

            if (isset($_POST['btnEliminarDevolucion'])) {
                if (empty($_GET['id_devolucion'])) {
                    echo '<script>alert("Debes llenar todos los campos"); window.location="edit_devolucion.php";</script>';
                }

                $query_update = "UPDATE libro l INNER JOIN devolucion d ON l.id_libro = d.id_libro SET l.cantidad = l.cantidad - 1 WHERE d.id_devolucion = ?";
                $stmt_update = $this->conn->prepare($query_update);
                $stmt_update->bind_param("i", $id_devolucion);
                $result_update = $stmt_update->execute();

                if (!$result_update) {
                    echo "Error de consulta al actualizar el prestamo" . mysqli_errno($this->conn);
                }

                $query = "DELETE FROM devolucion WHERE id_devolucion = ?";
                $stmt = $this->conn->prepare($query);
                $stmt->bind_param("i", $id_devolucion);
                $result = $stmt->execute();

                if (!$result) {
                    echo 'Error al eliminar el prestamo! ' . mysqli_errno($this->conn);
                }

                $_SESSION['message'] = 'Deleted';
                $_SESSION['message_type'] = 'danger';
            }

            $this->conn->close();
        }
        catch (Exception $e) {
            $this->conn->close();
            echo "Error en la función Delete hacia la base de datos! " . $e->getMessage();
        }
    }
}
