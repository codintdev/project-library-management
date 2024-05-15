<?php

require 'datos/Conexion.php';

class Usuario extends Conexion {

    public function create($id_usuario, $nombre, $apellido, $direccion, $telefono) {

        try {
            parent::conexion();

            if (isset($_POST['btnAgregarUsuario'])) {

                if (empty($_POST['txtIdUsuario'])) {
                    echo '<script>alert("Debes llenar todos los campos"); window.location="usuarios.php";</script>';
                }

                $query = "insert into usuario values (?, ?, ?, ?, ?)";
                $stmt = $this->conn->prepare($query);
                $stmt->bind_param("issss", $id_usuario, $nombre, $apellido, $direccion, $telefono);
                $resultado = $stmt->execute();

                if (!$resultado) {
                    echo '<script>alert("!Error al crear el usuario"); window.location="usuarios.php"</script>' . $resultado->Error();
                }

                echo "Created";

                header("Location: usuarios.php");
            }

            $this->conn->close();
        }
        catch (Exception $e) {
            $this->conn->close();
            echo "!Error al crear el usuario de la base de datos. " . $e->getMessage();
        }
    }

    public function index() {

        try {
            parent::conexion();

            $query = "select * from usuario order by id_usuario asc";
            $resultado = mysqli_query($this->conn, $query);

            while ($row = mysqli_fetch_array($resultado)) {

                echo "
                <tr>
                    <td>" . $row['id_usuario'] . "</td>
                    <td>" . $row['nombre_usuario'] . "</td>
                    <td>" . $row['apellido_usuario'] . "</td>
                    <td>" . $row['direccion'] . "</td>
                    <td>" . $row['telefono'] . "</td>
                </tr>
                ";
            }

            $this->conn->close();
        }
        catch (Exception $e) {
            $this->conn->close();
            echo "!Error al listar los usuarios de la base de datos. " . $e->getMessage();
        }
    }

    public function edit($id_usuario, $nombre, $apellido, $direccion, $telefono) {

        try {
            parent::conexion();

            if (isset($_POST['btnEditarUsuario'])) {

                if (empty($_POST['txtIdUsuario'])) {
                    echo '<script>alert("Debes llenar todos los campos"); window.location="usuarios.php";</script>';
                }

                $query = "update usuario set nombre_usuario = ?, apellido_usuario = ?, direccion = ?, telefono = ? where id_usuario = ?";
                $stmt = $this->conn->prepare($query);
                $stmt->bind_param("ssssi", $nombre, $apellido, $direccion, $telefono, $id_usuario);
                $resultado = $stmt->execute();

                if (!$resultado) {
                    echo '<script>alert("!Error al actualizar el usuario"); window.location="usuarios.php"</script>' . $resultado->Error();
                }

                echo "Saved";

                header("Location: usuarios.php");
            }

            $this->conn->close();
        }
        catch (Exception $e) {
            $this->conn->close();
            echo "!Error al actualizar el usuario de la base de datos. " . $e->getMessage();
        }
    }

    public function delete($id_usuario) {

        try {
            parent::conexion();

            if (isset($_POST['btnEliminarUsuario'])) {

                if (empty($_POST['txtIdUsuario'])) {
                    echo '<script>alert("Debes llenar todos los campos"); window.location="usuarios.php";</script>';
                }

                $query = "delete from usuario where id_usuario = ?";
                $stmt = $this->conn->prepare($query);
                $stmt->bind_param("i", $id_usuario);
                $resultado = $stmt->execute();

                if (!$resultado) {
                    echo '<script>alert("!Error al eliminar el usuario"); window.location="usuarios.php"</script>' . $resultado->Error();
                }

                echo "Deleted";

                header("Location: usuarios.php");
            }

            $this->conn->close();
        }
        catch (Exception $e) {
            $this->conn->close();
            echo "!Error al eliminar el usuario de la base de datos. " . $e->getMessage();
        }
    }
}
