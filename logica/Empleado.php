<?php

require 'datos/Conexion.php';

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

    public function create($id_empleado, $nombre, $apellido, $cargo) {

        try {
            parent::conexion();

            if (isset($_POST['btnAgregarEmpleado'])) {

                if (empty($_POST['txtIdEmpleado'])) {
                    echo '<script>alert("Debes llenar todos los campos"); window.location="empleados.php";</script>';
                }

                $query = "insert into empleado values (?, ?, ?, ?)";
                $stmt = $this->conn->prepare($query);
                $stmt->bind_param("isss", $id_empleado, $nombre, $apellido, $cargo);
                $resultado = $stmt->execute();

                if (!$resultado) {
                    echo '<script>alert("!Error al crear al empleado"); window.location="empleados.php"</script>' . $resultado->Error();
                }

                $_SESSION['message'] = 'Created';
                $_SESSION['message_type'] = 'success';

                header("Location: empleados.php");
            }

            $this->conn->close();
        }
        catch (Exception $e) {
            $this->conn->close();
            echo "!Error en la creación del empleado en la base de datos. " . $e->getMessage();
        }
    }

    public function index() {

        try {
            parent::conexion();

            $query = "select * from empleado order by id_empleado asc";
            $resultado = mysqli_query($this->conn, $query);
    
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
    
            $this->conn->close();
        }
        catch (Exception $e) {
            $this->conn->close();
            echo "!Error al listar todos los empleados de la base de datos. " . $e->getMessage();
        }
    }

    public function edit($id_empleado, $nombre, $apellido, $cargo) {

        try {
            parent::conexion();

            if (isset($_POST['btnActualizarEmpleado'])) {

                if (empty($_POST['txtIdEmpleado'])) {
                    echo '<script>alert("Debes llenar todos los campos"); window.location="empleados.php";</script>';
                }
    
                $query = "update empleado set nombre_empleado = ?, apellido_empleado = ?, cargo = ? where id_empleado = ?";
                $stmt = $this->conn->prepare($query);
                $stmt->bind_param("sssi", $nombre, $apellido, $cargo, $id_empleado);
                $resultado = $stmt->execute();
    
                if (!$resultado) {
                    echo '<script>alert("!Error al actualizar el empleado"); window.location="empleados.php"</script>' . $resultado->Error();
                }
                
                $_SESSION['message'] = 'Saved';
                $_SESSION['message_type'] = 'success';
    
                header("Location: empleados.php");
            }
    
            $this->conn->close();
        }
        catch (Exception $e) {
            $this->conn->close();
            echo "!Error al actualizar el empleado de la base de datos. " . $e->getMessage();
        }
    }

    public function delete($id_empleado) {

        try {
            parent::conexion();

            if (isset($_POST['btnEliminarEmpleado'])) {

                if (empty($_POST['txtIdEmpleado'])) {
                    echo '<script>alert("Debes llenar todos los campos"); window.location="empleados.php";</script>';
                }
    
                $query = "delete from empleado where id_empleado = ?";
                $stmt = $this->conn->prepare($query);
                $stmt->bind_param("i", $id_empleado);
                $resultado = $stmt->execute();
    
                if (!$resultado) {
                    echo '<script>alert("!Error al eliminar el empleado"); window.location="empleados.php"</script>' . $resultado->Error();
                }

                $_SESSION['message'] = 'Deleted';
                $_SESSION['message_type'] = 'success';
    
                header("Location: empleados.php");
            }
    
            $this->conn->close();
        }
        catch (Exception $e) {
            $this->conn->close();
            echo "!Error al eliminar el empleado de la base de datos. " . $e->getMessage();
        }
    }

    public function search() {

        try {
            parent::conexion();

            if (isset($_POST['btnBuscarEmpleado'])) {

                if (empty($_POST['txtIdEmpleado'])) {

                    echo '<script>alert("Debes llenar todos los campos"); window.location="empleados.php";</script>';
                }

                $id_empleado = $_POST['txtIdEmpleado'];

                $query = "select * from empleado where id_empleado = $id_empleado";
                $resultado = mysqli_query($this->conn, $query);

                if (!$resultado) {
                    echo '<script>alert("!Error al eliminar el empleado"); window.location="empleados.php"</script>';
                }
    
                header("Location: empleados.php");
            }

            $this->conn->close();
        }
        catch (Exception $e) {
            $this->conn->close();
            echo "!Error al buscar el empleado de la base de datos. " . $e->getMessage();
        }
    }

    public function editEmployee($id_empleado) {

        try {
            parent::conexion();

            if (isset($_GET['id_empleado'])) {
                $id = $_GET['id_empleado'];
                $query = "select * from empleado where id_empleado = $id";
                $result = mysqli_query($this->conn, $query);

                if (mysqli_num_rows($result) == 1) {
                    $row = mysqli_fetch_array($result);
                    $this->setId($row['id_empleado']);
                    $this->setNombre($row['nombre_empleado']);
                    $this->setApellido($row['apellido_empleado']);
                    $this->setCargo($row['cargo']);
                }
            }

            $this->conn->close();
        }
        catch (Exception $e) {
            $this->conn->close();
            echo "!Error no se encuentra el empleado en la base de datos. " . $e->getMessage();
        }
    }
}
