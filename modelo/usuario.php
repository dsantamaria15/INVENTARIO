<?php
include_once 'conexion.php';

class Usuario {
    var $objetos;

    public function __construct() { 
        $db = new Conexion();
        $this->acceso = $db->pdo;
    }

    public function loguearse($dni, $pass) {
        $sql = "SELECT * FROM usuario 
                INNER JOIN tipo_us ON us_tipo = id_tipo_us 
                WHERE dni_us = :dni AND contrasena_us = :pass";
        $query = $this->acceso->prepare($sql);
        $query->execute([':dni' => $dni, ':pass' => $pass]);
        $this->objetos = $query->fetchAll();
        return $this->objetos;
    }

    public function obtener_datos($id) {
        $sql = "SELECT * FROM usuario join tipo_us on us_tipo=id_tipo_us and id_usuario=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id));
        $this->objetos = $query->fetchAll();
        return $this->objetos;
    }
    function editar($id_usuario,$telefono,$residencia,$correo,$sexo,$adicional){
        $sql = "UPDATE usuario SET telefono_us=:telefono, residencia_us=:residencia, correo_us=:correo, sexo_us=:sexo, adicional_us=:adicional where id_usuario=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id_usuario,':telefono'=>$telefono,':residencia'=>$residencia,':correo'=>$correo,':sexo'=>$sexo,':adicional'=>$adicional));
    }
}
?>
