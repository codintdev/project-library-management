<?php

require 'config.php';

class Conexion {
    
    public $conn;

    // Función para la conexión hacia MySQL
    public function conexion() {

        try {
            $this->conn = mysqli_connect(HOST, USER, PASS, DB);
            //echo "<script>alert('Me conecte'); window.location='index.php';</script>";

            if (!$this->conn) {
                echo "Error al conectarse a la base de datos ";
            }
        }
        catch (Exception $e) {
            $this->conn->close();
            echo "Error al ingresar a la base de datos! " . $e->getMessage();
        }
    }
}
