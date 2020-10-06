<?php 
require_once 'modelojson.php';
class ControllerJson{
    public function createUsuarioController($fullname, $username, $password, $secretpin, $created){
        $datosController = array("fullname"=>$fullname,
        "username"=>$username,
        "password"=>$password,
        "secretpin"=>$secretpin,
        "created"=>$created);
        $respuesta=Datos::createUsuarioModel($datosController,"usuarios");
        return $respuesta;
    }
    public function readUsuariosController() { 
    $respuesta= Datos::readUsuarioModel("usuarios");
    return $respuesta; 
    }
        public function updateUsuariosController($id, $password) { 
        $datosController = array("id"=>$id, "password"=>$password);
        $respuesta= Datos::updateUsuarioModel($datosController,"usuarios"); 
        return $respuesta; 
        }
            public function deleteUsuariosController($id) { 
            $respuesta= Datos::deleteUsuarioModel($id,"usuarios");
            return $respuesta; 
            }
                public function loginUsuariosController($username, $password) { 
                    $datosController = array("username" => $username,
                "password"=>$password);
                $respuesta= Datos::loginUsuarioModel($datosController,"usuarios");
                return $respuesta; 
                }

}
$obj = new ControllerJson();
//$obj->createUsuarioController("mariana","luzmar","todocam","000100","2020-03-03 10:32:10");
//$obj->updateUsuariosController(6,"comenzal");
//$obj->readUsuariosController();
//$obj->loginUsuariosController("angel123","123abc");
$obj->deleteUsuariosController(11);
?>