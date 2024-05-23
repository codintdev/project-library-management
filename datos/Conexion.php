<?php

class Conexion {
    
    public $conn;

    public function conexion() {

        try {
            $this->conn = mysqli_connect('localhost', 'codintdev', 'andres2773', 'biblioteca');
            //echo "<script>alert('Me conecte'); window.location='index.php';</script>";

            if (!$this->conn) {
                echo "Error al conectarse";
            }
        }
        catch (Exception $e) {
            $this->conn->close();
            echo "Error al ingresar a la base de datos! " . $e->getMessage();
        }
    }
}
