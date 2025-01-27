<?php
class Conexion {
    private $servidor = "localhost";
    private $db = "inventario_sistema";
    private $puerto = 3306;
    private $charset = "utf8";
    private $usuario = "root";
    private $contrasena = "";
    public $pdo = null;
    private $atributos = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
        PDO::ATTR_EMULATE_PREPARES => false
    ];

    public function __construct() {
        try {
            $this->pdo = new PDO(
                "mysql:host={$this->servidor};dbname={$this->db};charset={$this->charset};port={$this->puerto}",
                $this->usuario,
                $this->contrasena,
                $this->atributos
            );
        } catch (PDOException $e) {
            die("Error de conexión: " . $e->getMessage());
        }
    }
}
?>