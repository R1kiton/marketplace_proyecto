<?php
$host     = "mysql-xxxx-tu-proyecto.aivencloud.com"; 
$port     = "12345";                                 
$dbname   = "defaultdb";                             
$username = "avnadmin";                             
$password = "tu_contraseña_aiven";                   
$ssl_ca   = __DIR__ . "/ca.pem";                     

try {
    $options = [
        PDO::MYSQL_ATTR_SSL_CA => $ssl_ca,
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ];

    $conn = new PDO("mysql:host=$host;port=$port;dbname=$dbname;charset=utf8", $username, $password, $options);
    
} catch (PDOException $e) {
    die("Error al conectar: " . $e->getMessage());
}
?>