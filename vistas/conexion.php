<?php
function conexion(){
    $pdo = new PDO('mysql:host=localhost;dbname=pdo', 'root', '');
    return $pdo;
}
?>

