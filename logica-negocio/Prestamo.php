<?php

require '../datos/Conexion.php';

class Prestamo extends Conexion {

    protected $id_prestamo;
    protected $id_usuario;
    protected $id_libro;
    protected $dias_prestamo;
    protected $id_empleado;

    public function setIdPrestamo($id_prestamo) {
        $this->id_prestamo = $id_prestamo;
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

    public function getIdPrestamo() {
        return $this->id_prestamo;
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

            $query = "SELECT pre.*, usu.*, lib.*, emp.* FROM prestamo pre INNER JOIN usuario usu ON pre.id_usuario = usu.id_usuario INNER JOIN libro lib ON pre.id_libro = lib.id_libro INNER JOIN empleado emp ON pre.id_empleado = emp.id_empleado ORDER BY id_prestamo ASC";
            $resultado = mysqli_query($this->conn, $query);

            if (!$resultado) {
                echo "Error en la consulta hacia la base de datos! :(" . mysqli_errno($this->conn);
            }
    
            while ($row = mysqli_fetch_array($resultado)) {
                echo "
                <tr>
                    <td>" . $row['id_prestamo'] . "</td>
                    <td>" . $row['nombre_usuario'] . "</td>
                    <td>" . $row['apellido_usuario'] . "</td>
                    <td>" . $row['direccion'] . "</td>
                    <td>" . $row['telefono'] . "</td>
                    <td>" . $row['titulo'] . "</td>
                    <td>" . $row['autor'] . "</td>
                    <td>" . $row['cantidad'] . "</td>
                    <td>" . $row['categoria'] . "</td>
                    <td>" . $row['fecha_prestamo'] . "</td>
                    <td>" . $row['nombre_empleado'] . "</td>
                    <td>" . $row['cargo'] . "</td>
                    <td>
                        <a href='edit_prestamo.php?id_prestamo=" . $row['id_prestamo'] . "' class='link-warning link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover'>Edit</a>
                    </td>
                </tr>
                ";
            }
    
            $this->conn->close();
        }
        catch (Exception $e) {
            $this->conn->close();
            echo "Error al listar los libros de la base de datos! " . $e->getMessage();
        }
    }

    public function create($id_usuario, $id_libro, $id_empleado) {

        try {
            parent::conexion();

            if (isset($_POST['btnAgregarPrestamo'])) {
                if (empty($_POST['txtIdLibro'])) {
                    echo '<script>alert("Debes llenar todos los campos"); window.location="new_prestamo.php";</script>';
                }

                $validatorLibro = "SELECT cantidad FROM libro WHERE id_libro = ?";
                $stmt_validator = $this->conn->prepare($validatorLibro);
                $stmt_validator->bind_param("i", $id_libro);
                $resultado = $stmt_validator->execute();
                $resultado = $stmt_validator->get_result();

                if (!$resultado) {
                    echo "Error en la consulta hacia la base de datos verifica los campos! :(" . mysqli_errno($this->conn);
                }

                $row = mysqli_fetch_assoc($resultado);

                if ($row['cantidad'] > 0) {
                    $query = "INSERT INTO prestamo VALUES (default, ?, ?, current_timestamp, ?)";
                    $stmt_crear = $this->conn->prepare($query);
                    $stmt_crear->bind_param("iii", $id_usuario, $id_libro, $id_empleado);
                    $resultado = $stmt_crear->execute();
        
                    if (!$resultado) {
                        echo 'Error al crear el prestamo! ' . mysqli_errno($this->conn);
                    }

                    $cantidadLibro = "UPDATE libro SET cantidad = cantidad - 1 WHERE id_libro = ?";
                    $stmt_cantidad = $this->conn->prepare($cantidadLibro);
                    $stmt_cantidad->bind_param("i", $id_libro);
                    $resultado = $stmt_cantidad->execute();

                    if (!$resultado) {
                        echo 'Error al actualizar la cantidad del libro ! ' . mysqli_errno($this->conn);
                    }

                    $_SESSION['message'] = 'Created';
                    $_SESSION['message_type'] = 'success';
                }
                else {
                    echo '<script>alert("Error no hay stock! "); window.location="new_prestamo.php"</script>';
                }
            }
    
            $this->conn->close();
        }
        catch (Exception $e) {
            $this->conn->close();
            echo "Error al crear el prestamo de la base de datos! " . $e->getMessage();
        }
    }

    public function info($id_prestamo) {

        try {
            parent::conexion();

            if (isset($_GET['id_prestamo'])) {
                //$id = $_GET['id_prestamo'];

                $query = "SELECT * FROM prestamo WHERE id_prestamo = $id_prestamo";
                $result = mysqli_query($this->conn, $query);

                if (mysqli_num_rows($result) == 1) {
                    $row = mysqli_fetch_array($result);
                    //$this->setIdPrestamo($row['id_prestamo']);
                    $this->setIdUsuario($row['id_usuario']);
                    $this->setIdLibro($row['id_libro']);
                    $this->setIdEmpleado($row['id_empleado']);
                }
            }

            $this->conn->close();
        }
        catch (Exception $e) {
            $this->conn->close();
            echo "Error no se encuentra el libro en la base de datos! " . $e->getMessage();
        }
    }

    public function edit($id_prestamo, $id_usuario, $id_libro, $id_empleado) {

        try {
            parent::conexion();

            if (isset($_POST['btnEditarPrestamo'])) {
                if (empty($_POST['txtNombrePrestamo'])) {
                    echo '<script>alert("Debes llenar todos los campos"); window.location="edit_prestamo.php";</script>';
                }

                $validatorLibro = "SELECT cantidad FROM libro WHERE id_libro = ?";
                $stmt_validator = $this->conn->prepare($validatorLibro);
                $stmt_validator->bind_param("i", $id_libro);
                $resultado = $stmt_validator->execute();
                $resultado = $stmt_validator->get_result();

                if (!$resultado) {
                    echo "Error en la consulta hacia la base de datos verifica los campos! :(" . mysqli_errno($this->conn);
                }

                $row = mysqli_fetch_assoc($resultado);

                if ($row['cantidad'] > 0) {
                    $query = "UPDATE prestamo SET id_usuario = ?, id_libro = ?, fecha_prestamo = current_timestamp, id_empleado = ? WHERE id_prestamo = ?";
                    $stmt = $this->conn->prepare($query);
                    $stmt->bind_param("iiii", $id_usuario, $id_libro, $id_empleado, $id_prestamo);
                    $resultado = $stmt->execute();
                    //$resultado = $stmt->get_result();
        
                    if (!$resultado) {
                        echo 'Error al actualizar el prestamo! ' . mysqli_errno($this->conn);
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
                else {
                    echo '<script>alert("Error no hay stock!"); window.location="edit_prestamo.php"</script>';
                }
            }
    
            $this->conn->close();
        }
        catch (Exception $e) {
            $this->conn->close();
            echo "Error al actualizar el prestamo de la base de datos! " . $e->getMessage();
        }
    }

    public function delete($id_prestamo) {

        try {
            parent::conexion();

            if (isset($_POST['btnEliminarPrestamo'])) {
                if (empty($_GET['id_prestamo'])) {
                    echo '<script>alert("Debes llenar todos los campos"); window.location="edit_prestamo.php";</script>';
                }

                $query_update = "UPDATE libro l INNER JOIN prestamo p ON l.id_libro = p.id_libro set l.cantidad = l.cantidad + 1 WHERE p.id_prestamo = ?";
                $stmt_update = $this->conn->prepare($query_update);
                $stmt_update->bind_param("i", $id_prestamo);
                $result_update = $stmt_update->execute();

                if (!$result_update) {
                    echo "Error de consulta al actualizar el prestamo" . mysqli_errno($this->conn);
                }

                $query_delete = "DELETE FROM prestamo WHERE id_prestamo = ?";
                $stmt_delete = $this->conn->prepare($query_delete);
                $stmt_delete->bind_param("i", $id_prestamo);
                $result_delete = $stmt_delete->execute();

                if (!$result_delete) {
                    echo 'Error al eliminar el prestamo! ' . mysqli_errno($this->conn);
                }
                
                $_SESSION['message'] = 'Deleted';
                $_SESSION['message_type'] = 'danger';
            }
    
            $this->conn->close();
        }
        catch (Exception $e) {
            $this->conn->close();
            echo "Error al eliminar el prestamo de la base de datos! " . $e->getMessage();
        }
    }
}
