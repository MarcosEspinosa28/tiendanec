<?php
require_once 'database.php';
class Datos extends Database 
{ 
#Metodos 
//----------------------------------------------------------------------------- 
    public function createUsuarioModel($datosmodel,$tabla){
        $stmt = Database::getConnection()->prepare("INSERT INTO $tabla (fullname, username, password, secretpin,
        created) VALUES (:fullname, :username, :password, :secretpin, :created)");
        $stmt->bindParam(":fullname",$datosmodel["fullname"],PDO::PARAM_STR);
        $stmt->bindParam(":username",$datosmodel["username"],PDO::PARAM_STR);
        $stmt->bindParam(":password",$datosmodel["password"],PDO::PARAM_STR); 
        $stmt->bindParam(":secretpin",$datosmodel["secretpin"],PDO::PARAM_INT);
        $stmt->bindParam(":created",$datosmodel["created"],PDO::PARAM_STR); 
        if($stmt->execute()){
            echo"Registro exitoso";
        }else{
            echo"No Se Pudo Hacer El Registro";
        }
    }
    public function readUsuarioModel($tabla){
        $stmt = Database::getConnection()->prepare("SELECT id, fullname, username, password, secretpin, created
        FROM $tabla");
        $stmt->execute();
        $stmt->bindColumn("id", $id);
        $stmt->bindColumn("fullname", $fullname);
        $stmt->bindColumn("username", $username);
        $stmt->bindColumn("password", $password); 
        $stmt->bindColumn("secretpin", $secretpin);
        $stmt->bindColumn("created", $created);
        $usuarios= array(); 
       while ($fila= $stmt->fetch(PDO::FETCH_BOUND)){ 
        $user = array();
        $user["id"] = utf8_encode($id);
        $user["fullname"] = utf8_encode($fullname);
        $user["username"] = utf8_encode($username);
        $user["password"] = utf8_encode($password);
        $user["secretpin"] = utf8_encode($secretpin);
        $user["created"] = utf8_encode($created);
        array_push($usuarios, $user);
        echo'
        <tr>
        <td>',$user['id'].'</td>
        <td>',$user['fullname'].'</td>
        <td>',$user['username'].'</td>
        <td>',$user['password'].'</td>
        <td>',$user['secretpin'].'</td>
        <td>',$user['created'].'</td>';


       }
       echo'</table>';
       return $usuarios;
    }
            public function updateUsuarioModel($datosmodel,$tabla){
            $stmt = Database::getConnection()->prepare("UPDATE $tabla set password= :password WHERE id= :id"); 
   
           $stmt->bindParam(":password",$datosmodel["password"],PDO::PARAM_STR);
           $stmt->bindParam(":id",$datosmodel["id"],PDO::PARAM_INT);
           if($stmt->execute()) { 
            echo "Actualizacion Exitosa";
            }else{ 
            echo "No se pudo hacer la Actualizacion"; 
            }
        }
        public function deleteUsuarioModel($id,$tabla){
            $stmt=Database::getConnection()->prepare("DELETE FROM $tabla WHERE id=:id");
            $stmt->bindParam(":id",$id,PDO::PARAM_INT); 
            if($stmt->execute()){
            echo "Usuario eliminado correctamente"; 
            }else{
            echo "El Usuario no se pudo eliminar"; 
            }
        }
        public function loginUsuarioModel($datosModel, $tabla){
            $stmt=Database::getConnection()->prepare("SELECT id, fullname, username, password, secretpin, created FROM $tabla WHERE username = :username AND password =:password");
            $stmt->bindParam(":username",$datosModel["username"]);
            $stmt->bindParam(":password",$datosModel["password"]); 
            $stmt->execute();
            $stmt->bindColumn("id", $id);
            $stmt->bindColumn("fullname", $fullname); 
            $stmt->bindColumn("username", $username);
            $stmt->bindColumn("password", $password); 
            $stmt->bindColumn("secretpin", $secretpin);
            $stmt->bindColumn("created", $created); 
            echo'
            <table>
            <tr>
            <td><strong>ID</strong></td>
            <td><strong>fullname</strong></td>
            <td><strong>Username</strong></td>
            <td><strong>Password</strong></td>
            <td><strong>Secretpin</strong></td>
            <td><strong>Created</strong></td>';

            while ($fila= $stmt->fetch(PDO::FETCH_BOUND)){
            $user = array();
            $user["id"] = utf8_encode($id);
            $user["fullname"]= utf8_encode($fullname); 
            $user["username"] = utf8_encode($username);
            $user["password"] = utf8_encode($password); 
            $user["secretpin"] = utf8_encode($secretpin);      
            $user["created"] = utf8_encode($created);        
            echo'
            <tr>
            <td>',$user['id'].'</td>
            <td>',$user['fullname'].'</td>
            <td>',$user['username'].'</td>
            <td>',$user['password'].'</td>
            <td>',$user['secretpin'].'</td>
            <td>',$user['created'].'</td>';
        }
            if(!empty($user)) {
            return $user; 
            }else{
            return false; 
            }
        }
}
?> 