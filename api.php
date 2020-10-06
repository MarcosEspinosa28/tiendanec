<?php
require_once 'controllerjson.php';
function isTheseParametersAvailable($params){
    $available = true;
    $missingparams = "";
    foreach($params as $param){
        if(!isset($_POST[$param]) || strlen($_POST[$param]) <= 0){
            $available = false;
            $missingparams = $missingparams.",".$param;
        }
    }
    if(!$available){
        $response= array();
        $response['error'] = true;
        $response['message']='Parametro:'.substr($missingparams,1,strlen($missingparams)).'vacio';
        echo json_encode($response); 
        die() ;
    }
}
$response= array(); 
if(isset($_GET['apicall'])){
    switch($_GET['apicall']){
        case 'createusuario':
            isTheseParametersAvailable(array('fullname','username','password','secretpin','created'));
            $db= new controllerjson();
            $result = $db->createUsuarioController($_POST['fullname'],
            $_POST['username'],
            $_POST['password'],
            $_POST['secretpin'],
            $_POST['created']);
            if($result){
                $response['error'] = false;
                $response['message'] = 'Usuario agregado correctamente';
                $response['contenido'] = $db->readUsuariosController();
            }else{
                $response['error'] = true;
                $response['message']='ocurrio un error, intenta nuevamente';
            }
        break;
        case 'readusuarios':
                $db = new controllerjson();
                $response['error'] = false;
                $response['message']='Solicitud completada';
                $response['contenido']= $db->readUsuariosController();            
        break;
            $response['message'] = 'Solicitud completada correctamente';
            $response['contenido'] = $db->readUsuariosController();
        case 'loginusuario':
            isTheseParametersAvailable(array('username','password'));
            $db = new controllerjson();
            $result = $db->loginUsuariosController($_POST['username'],$_POST['password']);
            if(!$result){
                $response['error'] =true;
                $response['menssage'] = 'credenciales no validas';
            }else{
                $response['error'] = false;
                $response['message'] = 'Bienvenido';
                $response['contenido'] = $result;
            }
        break;
    }
}else{
        //si no es un api el que se esta invocando
        //empujar los valores apropiados en la estructura json
        $response['error'] = true;
        $response['message'] = 'Llamado Invalido del API';
    }
    echo json_encode($response); 
?>
