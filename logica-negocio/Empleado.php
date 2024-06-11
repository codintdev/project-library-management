<?php

require '../datos/Conexion.php';

class Empleado extends Conexion {
    
    protected $id_empleado;
    protected $nombre;
    protected $apellido;
    protected $cargo;

    public function setId($id_empleado) {
        $this->id_empleado = $id_empleado;
    }
    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }
    public function setApellido($apellido) {
        $this->apellido = $apellido;
    }
    public function setCargo($cargo) {
        $this->cargo = $cargo;
    }

    public function getId() {
        return $this->id_empleado;
    }
    public function getNombre() {
        return $this->nombre;
    }
    public function getApellido() {
        return $this->apellido;
    }
    public function getCargo() {
        return $this->cargo;
    }

    public function index() {

        try {
            parent::conexion();

            if (isset($_POST['btnFiltrarEmpleado'])) {
                $this->filtro();
            }
            else if (isset($_POST['btnBuscarEmpleado'])) {
                $this->search($_POST['txtBuscarEmpleado']);
            }
            else {
                $query = "SELECT * FROM empleado ORDER BY id_empleado ASC";
                $resultado = mysqli_query($this->conn, $query);
    
                if (!$resultado) {
                    echo "Error en la consulta hacia la base de datos! " . mysqli_errno($this->conn);
                }
        
                while ($row = mysqli_fetch_array($resultado)) {
                    echo "
                    <tr>
                        <td>" . $row['id_empleado'] . "</td>
                        <td>" . $row['nombre_empleado'] . "</td>
                        <td>" . $row['apellido_empleado'] . "</td>
                        <td>" . $row['cargo'] . "</td>
                        <td>
                            <a href='edit_empleado.php?id_empleado=" . $row['id_empleado'] . "' class='link-warning link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover'>Edit</a>
                        </td>
                    </tr>
                    ";
                }
            }            
    
            $this->conn->close();
        }
        catch (Exception $e) {
            $this->conn->close();
            echo "Error al listar todos los empleados de la base de datos! " . $e->getMessage();
        }
    }

    public function create($nombre, $apellido, $cargo) {

        try {
            parent::conexion();

            if (isset($_POST['btnAgregarEmpleado'])) {
                if (empty($_POST['txtNombreEmpleado'])) {
                    echo '<script>alert("Debes llenar todos los campos"); window.location="new_empleado.php";</script>';
                }

                $query = "INSERT INTO empleado VALUES (default, ?, ?, ?)";
                $stmt = $this->conn->prepare($query);
                $stmt->bind_param("sss", $nombre, $apellido, $cargo);
                $resultado = $stmt->execute();

                if (!$resultado) {
                    echo "Error en la consulta hacia la base de datos verifica los campos! :(" . mysqli_errno($this->conn);
                }

                $_SESSION['message'] = 'Created';
                $_SESSION['message_type'] = 'success';
            }

            $this->conn->close();
        }
        catch (Exception $e) {
            $this->conn->close();
            echo "!Error en la creación del empleado en la base de datos. " . $e->getMessage();
        }
    }

    public function info($id_empleado) {

        try {
            parent::conexion();

            if (isset($_GET['id_empleado'])) {
                //$id_empleado = $_GET['id_empleado'];

                $query = "SELECT * FROM empleado WHERE id_empleado = $id_empleado";
                $result = mysqli_query($this->conn, $query);

                if (!$result) {
                    echo "Error en la consulta hacia la base de datos verifica los campos! :(" . mysqli_errno($this->conn);
                }

                if (mysqli_num_rows($result) == 1) {
                    $row = mysqli_fetch_array($result);
                    //$this->setId($row['id_empleado']);
                    $this->setNombre($row['nombre_empleado']);
                    $this->setApellido($row['apellido_empleado']);
                    $this->setCargo($row['cargo']);
                }
            }

            $this->conn->close();
        }
        catch (Exception $e) {
            $this->conn->close();
            echo "Error no se encuentra el empleado en la base de datos! " . $e->getMessage();
        }
    }

    public function edit($id_empleado, $nombre, $apellido, $cargo) {

        try {
            parent::conexion();

            if (isset($_POST['btnActualizarEmpleado'])) {
                if (empty($_POST['txtNombreEmpleado'])) {
                    echo '<script>alert("Debes llenar todos los campos"); window.location="edit_empleado.php";</script>';
                }
    
                $query = "UPDATE empleado SET nombre_empleado = ?, apellido_empleado = ?, cargo = ? WHERE id_empleado = ?";
                $stmt = $this->conn->prepare($query);
                $stmt->bind_param("sssi", $nombre, $apellido, $cargo, $id_empleado);
                $resultado = $stmt->execute();
    
                if (!$resultado) {
                    echo "Error en la consulta hacia la base de datos verifica los campos! :(" . mysqli_errno($this->conn);
                }
                
                $_SESSION['message'] = 'Saved';
                $_SESSION['message_type'] = 'warning';
            }
    
            $this->conn->close();
        }
        catch (Exception $e) {
            $this->conn->close();
            echo "Error al actualizar el empleado de la base de datos! " . $e->getMessage();
        }
    }

    public function delete($id_empleado) {

        try {
            parent::conexion();

            if (isset($_POST['btnEliminarEmpleado'])) {
                if (empty($_POST['txtNombreEmpleado'])) {
                    echo '<script>alert("Debes llenar todos los campos"); window.location="empleados.php";</script>';
                }
    
                $query = "DELETE FROM empleado WHERE id_empleado = ?";
                $stmt = $this->conn->prepare($query);
                $stmt->bind_param("i", $id_empleado);
                $resultado = $stmt->execute();
    
                if (!$resultado) {
                    echo "Error en la consulta hacia la base de datos verifica los campos! :(" . mysqli_errno($this->conn);
                }

                $_SESSION['message'] = 'Deleted';
                $_SESSION['message_type'] = 'danger';
            }
    
            $this->conn->close();
        }
        catch (Exception $e) {
            $this->conn->close();
            echo "Error al eliminar el empleado de la base de datos! " . $e->getMessage();
        }
    }

    public function filtro() {
        try {
            parent::conexion();
                
            $query = "SELECT * FROM empleado ORDER BY cargo ASC";
            $result = mysqli_query($this->conn, $query);

            if (!$result) {
                echo "Error en la consulta hacia la base de datos! :(" . mysqli_errno($this->conn);
            }
        
            while ($row = mysqli_fetch_array($result)) {
                echo "
                <tr>
                    <td>" . $row['id_empleado'] . "</td>
                    <td>" . $row['nombre_empleado'] . "</td>
                    <td>" . $row['apellido_empleado'] . "</td>
                    <td>" . $row['cargo'] . "</td>
                    <td>
                        <a href='edit_empleado.php?id_empleado=" . $row['id_empleado'] . "' class='link-warning link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover'>Edit</a>
                    </td>
                </tr>
                ";
            }

            $this->conn->close();
        }
        catch (Exception $e) {
            $this->conn->close();
            echo "Error al filtrar el cargo en la base de datos! " . $e->getMessage();
        }
    }

    public function search($nombre) {

        try {
            parent::conexion();

            //if (isset($_POST['btnBuscarEmpleado'])) {
                if (empty($_POST['txtBuscarEmpleado'])) {
                    echo '<script>alert("Debes llenar todos los campos"); window.location="empleados.php";</script>';
                }

                $query = "SELECT * FROM empleado WHERE nombre_empleado LIKE '%$nombre%' LIMIT 10";
                //$query = "select * from empleado where nombre_empleado = '$nombre'";
                $result = mysqli_query($this->conn, $query);

                if (!$result) {
                    echo 'Error al buscar el empleado ';
                }

                while ($row = mysqli_fetch_array($result)) {
                    echo "
                    <tr>
                        <td>" . $row['id_empleado'] . "</td>
                        <td>" . $row['nombre_empleado'] . "</td>
                        <td>" . $row['apellido_empleado'] . "</td>
                        <td>" . $row['cargo'] . "</td>
                        <td>
                            <a href='edit_empleado.php?id_empleado=" . $row['id_empleado'] . "' class='link-warning link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover'>Edit</a>
                        </td>
                    </tr>
                    ";
                }

            //}

            $this->conn->close();
        }
        catch (Exception $e) {
            $this->conn->close();
            echo "Error al buscar el empleado de la base de datos! " . $e->getMessage();
        }
    }
}
