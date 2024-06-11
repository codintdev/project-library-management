<?php

require '../datos/Conexion.php';

class Usuario extends Conexion {

    protected $id_usuario;
    protected $nombre;
    protected $apellido;
    protected $direccion;
    protected $telefono;
    protected $multa;

    public function setId($id_usuario) {
        $this->id_usuario = $id_usuario;
    }
    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }
    public function setApellido($apellido) {
        $this->apellido = $apellido;
    }
    public function setDireccion($direccion) {
        $this->direccion = $direccion;
    }
    public function setTelefono($telefono) {
        $this->telefono = $telefono;
    }
    public function setMulta($multa) {
        $this->multa = $multa;
    }

    public function getId() {
        return $this->id_usuario;
    }
    public function getNombre() {
        return $this->nombre;
    }
    public function getApellido() {
        return $this->apellido;
    }
    public function getDireccion() {
        return $this->direccion;
    }
    public function getTelefono() {
        return $this->telefono;
    }
    public function getMulta() {
        return $this->multa;
    }

    public function index() {

        try {
            parent::conexion();

            if (isset($_POST['btnBuscarUsuario'])) {
                $this->search($_POST['txtBuscarUsuario']);
            }
            else {
                $query = "SELECT * FROM usuario ORDER BY id_usuario ASC";
                $resultado = mysqli_query($this->conn, $query);
    
                if (!$resultado) {
                    echo "Error en la consulta hacia la base de datos! :(" . mysqli_errno($this->conn);
                }
    
                while ($row = mysqli_fetch_array($resultado)) {
                    echo "
                    <tr>
                        <td>" . $row['id_usuario'] . "</td>
                        <td>" . $row['nombre_usuario'] . "</td>
                        <td>" . $row['apellido_usuario'] . "</td>
                        <td>" . $row['direccion'] . "</td>
                        <td>" . $row['telefono'] . "</td>
                        <td>" . $row['multa'] . "</td>
                        <td>
                            <a href='edit_usuario.php?id_usuario=" . $row['id_usuario'] . "' class='link-warning link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover'>Edit</a>
                        </td>
                    </tr>
                    ";
                }
            }

            $this->conn->close();
        }
        catch (Exception $e) {
            $this->conn->close();
            echo "Error al listar los usuarios de la base de datos! " . $e->getMessage();
        }
    }

    public function create($nombre, $apellido, $direccion, $telefono) {

        try {
            parent::conexion();

            if (isset($_POST['btnAgregarUsuario'])) {
                if (empty($_POST['txtNombreUsuario'])) {
                    echo '<script>alert("Debes llenar todos los campos"); window.location="new_usuario.php";</script>';
                }

                $query = "INSERT INTO usuario VALUES (default, ?, ?, ?, ?, 0)";
                $stmt = $this->conn->prepare($query);
                $stmt->bind_param("ssss", $nombre, $apellido, $direccion, $telefono);
                $resultado = $stmt->execute();

                if (!$resultado) {
                    echo 'Error al crear el usuario! ' . mysqli_errno($this->conn);
                }

                $_SESSION['message'] = 'Created';
                $_SESSION['message_type'] = 'success';
            }

            $this->conn->close();
        }
        catch (Exception $e) {
            $this->conn->close();
            echo "Error al crear el usuario de la base de datos! " . $e->getMessage();
        }
    }

    public function info($id_usuario) {

        try {
            parent::conexion();

            if (isset($_GET['id_usuario'])) {
                //$id = $_GET['id_usuario'];

                $query = "SELECT * FROM usuario WHERE id_usuario = $id_usuario";
                $result = mysqli_query($this->conn, $query);

                if (!$result) {
                    echo "Error en la consulta hacia la base de datos verifica los campos! :(" . mysqli_errno($this->conn);
                }

                if (mysqli_num_rows($result) == 1) {
                    $row = mysqli_fetch_array($result);
                    //$this->setId($row['id_usuario']);
                    $this->setNombre($row['nombre_usuario']);
                    $this->setApellido($row['apellido_usuario']);
                    $this->setDireccion($row['direccion']);
                    $this->setTelefono($row['telefono']);
                    $this->setMulta($row['multa']);
                }
            }

            $this->conn->close();
        }
        catch (Exception $e) {
            $this->conn->close();
            echo "Error no se encuentra el empleado en la base de datos! " . $e->getMessage();
        }
    }

    public function edit($id_usuario, $nombre, $apellido, $direccion, $telefono) {

        try {
            parent::conexion();

            if (isset($_POST['btnEditarUsuario'])) {
                if (empty($_POST['txtNombreUsuario'])) {
                    echo '<script>alert("Debes llenar todos los campos"); window.location="edit_usuario.php";</script>';
                }

                $query = "UPDATE usuario SET nombre_usuario = ?, apellido_usuario = ?, direccion = ?, telefono = ? WHERE id_usuario = ?";
                $stmt = $this->conn->prepare($query);
                $stmt->bind_param("ssssi", $nombre, $apellido, $direccion, $telefono, $id_usuario);
                $resultado = $stmt->execute();

                if (!$resultado) {
                    echo 'Error al actualizar el usuario! ' . mysqli_errno($this->conn);
                }

                $_SESSION['message'] = 'Saved';
                $_SESSION['message_type'] = 'warning';
            }

            $this->conn->close();
        }
        catch (Exception $e) {
            $this->conn->close();
            echo "Error al actualizar el usuario de la base de datos! " . $e->getMessage();
        }
    }

    public function delete($id_usuario) {

        try {
            parent::conexion();

            if (isset($_POST['btnEliminarUsuario'])) {
                if (empty($_GET['id_usuario'])) {
                    echo '<script>alert("Debes llenar todos los campos"); window.location="edit_usuario.php";</script>';
                }

                $query = "DELETE FROM usuario WHERE id_usuario = ?";
                $stmt = $this->conn->prepare($query);
                $stmt->bind_param("i", $id_usuario);
                $resultado = $stmt->execute();

                if (!$resultado) {
                    echo 'Error al eliminar el usuario! ' . mysqli_errno($this->conn);
                }

                $_SESSION['message'] = 'Deleted';
                $_SESSION['message_type'] = 'danger';
            }

            $this->conn->close();
        }
        catch (Exception $e) {
            $this->conn->close();
            echo "Error al eliminar el usuario de la base de datos! " . $e->getMessage();
        }
    }

    public function search($nombre) {
        try {
            parent::conexion();

            if (empty($_POST['txtBuscarUsuario'])) {
                echo '<script>alert("Debes llenar todos los campos"); window.location="empleados.php";</script>';
            }

            $query = "SELECT * FROM usuario WHERE nombre_usuario = '$nombre'";
            $result = mysqli_query($this->conn, $query);

            if (!$result) {
                echo 'Error al buscar el usuario: ' . mysqli_errno($this->conn);
            }

            while ($row = mysqli_fetch_array($result)) {
                echo "
                <tr>
                    <td>" . $row['id_usuario'] . "</td>
                    <td>" . $row['nombre_usuario'] . "</td>
                    <td>" . $row['apellido_usuario'] . "</td>
                    <td>" . $row['direccion'] . "</td>
                    <td>" . $row['telefono'] . "</td>
                    <td>" . $row['multa'] . "</td>
                    <td>
                        <a href='edit_usuario.php?id_usuario=" . $row['id_usuario'] . "' class='link-warning link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover'>Edit</a>
                    </td>
                </tr>
                ";
            }

            $this->conn->close();
        }
        catch (Exception $e) {

        }
    }
}
