<?php
class Database{
    public function getConnection(){
    $localhost = 'b8td88pla60hdidlq1ep-mysql.services.clever-cloud.com'; 
    $database = 'b8td88pla60hdidlq1ep';
    $user = 'uuv2g1375pui9chg'; 
    $password = 'AHcKuQzrohSomjunsS19';
    $link=new PDO("mysql:host=$localhost;dbname=$database", $user, $password); 
    return $link;
    } 
}
?> 