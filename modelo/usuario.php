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
    function cambiar_contra($id_usuario,$oldpass,$newpass){
        $sql = "SELECT * FROM usuario where id_usuario=:id and contrasena_us=:oldpass";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id_usuario,':oldpass'=>$oldpass));
        $this->objetos = $query->fetchall();
        if(!empty($this->objetos)){
            $sql="UPDATE usuario SET contrasena_us=:newpass where id_usuario=:id";
            $query=$this->acceso->prepare($sql);
            $query->execute(array(':id'=>$id_usuario,':newpass'=>$newpass));
            echo 'update';
        }
        else{
            echo 'noupdate';
        }
    }
    function cambiar_photo($id_usuario,$nombre){
        $sql = "SELECT avatar FROM usuario where id_usuario=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id_usuario));
        $this->objetos = $query->fetchall();
        
            $sql="UPDATE usuario SET avatar=:nombre where id_usuario=:id";
            $query=$this->acceso->prepare($sql);
            $query->execute(array(':id'=>$id_usuario,':nombre'=>$nombre));
        return $this->objetos;
        }
        function buscar(){
            if(!empty($_POST['consulta'])){
                $consulta=$_POST['consulta'];
                $sql="SELECT * FROM usuario join tipo_us on us_tipo=id_tipo_us where nombre_us LIKE :consulta";
                $query = $this->acceso->prepare($sql);
                $query->execute(array(':consulta'=>"%$consulta%"));
                $this->objetos=$query->fetchall();
                return $this->objetos;
            }
            else{
                $sql="SELECT * FROM usuario JOIN tipo_us ON us_tipo=id_tipo_us WHERE nombre_us NOT LIkE '' ORDER BY id_usuario LIMIT 25";
                $query = $this->acceso->prepare($sql);
                $query->execute();
                $this->objetos=$query->fetchall();
                return $this->objetos;
            }
        }
        function crear($nombre,$apellidos,$edad,$dni,$pass,$tipo,$avatar){
            $sql="SELECT id_usuario FROM  usuario WHERE dni_us = :dni";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':dni'=>$dni));
            $this->objetos=$query->fetchall();
            if(!empty($this->objetos)){
                echo 'no_agregado';
            }
            else{
                $sql="INSERT INTO usuario(nombre_us,apellidos_us,edad,dni_us,contrasena_us,us_tipo,avatar) VALUES (:nombre,:apellidos,:edad,:dni,:pass,:tipo,:avatar)";
                $query = $this->acceso->prepare($sql);
                $query->execute(array(':nombre'=>$nombre,':apellidos'=>$apellidos,':edad'=>$edad,':dni'=>$dni,':pass'=>$pass,':tipo'=>$tipo,':avatar'=>$avatar));
                echo 'agregado';
            }
        }
    }
?>

