<?php

require 'datos/Conexion.php';

class Libro extends Conexion {

    protected $id_libro;
    protected $titulo;
    protected $autor;
    protected $cantidad;
    protected $categoria;

    public function setId($id_libro) {
        $this->id_libro = $id_libro;
    }
    public function setTitulo($titulo) {
        $this->titulo = $titulo;
    }
    public function setAutor($autor) {
        $this->autor = $autor;
    }
    public function setCantidad($cantidad) {
        $this->cantidad = $cantidad;
    }
    public function setCategoria($categoria) {
        $this->categoria = $categoria;
    }

    public function getId() {
        return $this->id_libro;
    }
    public function getTitulo() {
        return $this->titulo;
    }
    public function getAutor() {
        return $this->autor;
    }
    public function getCantidad() {
        return $this->cantidad;
    }
    public function getCategoria() {
        return $this->categoria;
    }

    public function create($id_libro, $titulo, $autor, $cantidad, $categoria) {

        try {
            parent::conexion();

            if (isset($_POST['btnAgregarLibro'])) {

                if (empty($_POST['txtIdLibro'])) {
                    echo '<script>alert("Debes llenar todos los campos"); window.location="libros.php";</script>';
                }

                $query = "insert into libro values (?, ?, ?, ?, ?)";
                $stmt = $this->conn->prepare($query);
                $stmt->bind_param("issis", $id_libro, $titulo, $autor, $cantidad, $categoria);
                $resultado = $stmt->execute();

                if (!$resultado) {
                    echo '<script>alert("!Error al crear el libro"); window.location="libros.php"</script>';
                }

                $_SESSION['message'] = 'Created';
                $_SESSION['message_type'] = 'success';

                header("Location: libros.php");
            }

            $this->conn->close();
        }
        catch (Exception $e) {
            $this->conn->close();
            echo "!Error al crear el libro de la base de datos. " . $e->getMessage();
        }
    }

    public function index() {

        try {
            parent::conexion();

            $query = "select * from libro order by id_libro asc";
            $resultado = mysqli_query($this->conn, $query);

            while ($row = mysqli_fetch_array($resultado)) {

                echo "
                <tr>
                    <td>" . $row['id_libro'] . "</td>
                    <td>" . $row['titulo'] . "</td>
                    <td>" . $row['autor'] . "</td>
                    <td>" . $row['cantidad'] . "</td>
                    <td>" . $row['categoria'] . "</td>
                    <td>
                        <a href='edit_libro.php?id_libro=" . $row['id_libro'] . "' class='link-warning link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover'>Edit</a>
                    </td>
                </tr>
                ";
            }

            $this->conn->close();
        }
        catch (Exception $e) {
            $this->conn->close();
            echo "!Error al listar los libros de la base de datos. " . $e->getMessage();
        }
    }

    public function edit($id_libro, $titulo, $autor, $cantidad, $categoria) {

        try {
            parent::conexion();

            if (isset($_POST['btnEditarLibro'])) {

                if (empty($_POST['txtIdLibro'])) {
                    echo '<script>alert("Debes llenar todos los campos"); window.location="libros.php";</script>';
                }

                $query = "update libro set titulo = ?, autor = ?, cantidad = ?, categoria = ? where id_libro = ?";
                $stmt = $this->conn->prepare($query);
                $stmt->bind_param("ssisi", $titulo, $autor, $cantidad, $categoria, $id_libro);
                $resultado = $stmt->execute();

                if (!$resultado) {
                    echo '<script>alert("!Error al actualizar el libro"); window.location="libros.php"</script>' . $resultado->Error();
                }

                $_SESSION['message'] = 'Saved';
                $_SESSION['message_type'] = 'success';

                header("Location: libros.php");
            }   

            $this->conn->close();
        }
        catch (Exception $e) {
            $this->conn->close();
            echo "!Error al actualizar el libro de la base de datos. " . $e->getMessage();
        }
    }

    public function delete($id_libro) {

        try {
            parent::conexion();

            if (isset($_POST['btnEliminarLibro'])) {

                if (empty($_GET['id_libro'])) {
                    echo '<script>alert("Debes llenar todos los campos"); window.location="libros.php";</script>';
                }
    
                $query = "delete from libro where id_libro = ?";
                $stmt = $this->conn->prepare($query);
                $stmt->bind_param("i", $_GET['id_libro']);
                $resultado = $stmt->execute();
    
                if (!$resultado) {
                    echo '<script>alert("!Error al eliminar el libro"); window.location="libros.php"</script>' . $resultado->Error();
                }

                $_SESSION['message'] = 'Deleted';
                $_SESSION['message_type'] = 'success';
    
                header("Location: libros.php");
            }
    
            $this->conn->close();
        }
        catch (Exception $e) {
            $this->conn->close();
            echo "!Error al eliminar el empleado de la base de datos. " . $e->getMessage();
        }
    }

    public function changeCategory($id_libro, $categoria) {

        try {
            parent::conexion();

            if (isset($_POST['btnCambiarCategoria'])) {

                if (empty($_POST['txtIdLibro'])) {
                    echo '<script>alert("Debes llenar todos los campos"); window.location="libros.php";</script>';
                }

                $query = "update libro set categoria = ? where id_libro = ?";
                $stmt = $this->conn->prepare($query);
                $stmt->bind_param("si", $categoria, $id_libro);
                $resultado = $stmt->execute();

                if (!$resultado) {
                    echo '<script>alert("!Error al actualizar la categoria del libro"); window.location="libros.php"</script>' . $resultado->Error();
                }

                echo "Saved";

                header("Location: libros.php");
            }

            $this->conn->close();
        }
        catch (Exception $e) {
            $this->conn->close();
            echo "!Error al actualizar la categoria del libro en la base de datos. " . $e->getMessage();
        }
    }

    public function editBook($id_libro) {

        try {
            parent::conexion();

            if (isset($_GET['id_libro'])) {
                $id = $_GET['id_libro'];
                $query = "select * from libro where id_libro = $id";
                $result = mysqli_query($this->conn, $query);

                if (mysqli_num_rows($result) == 1) {
                    $row = mysqli_fetch_array($result);
                    $this->setId($row['id_libro']);
                    $this->setTitulo($row['titulo']);
                    $this->setAutor($row['autor']);
                    $this->setCantidad($row['cantidad']);
                    $this->setCategoria($row['categoria']);
                }
            }
        }
        catch (Exception $e) {
            $this->conn->close();
            echo "!Error no se encuentra el libro en la base de datos. " . $e->getMessage();
        }
    }
}
