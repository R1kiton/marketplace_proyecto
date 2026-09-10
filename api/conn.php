<?php
$host     = "mysql-1a314ecb-mercado-fake.b.aivencloud.com"; 
$port     = "14161";                                 
$dbname   = "defaultdb";                             
$username = "avnadmin";                             
$pass = "AVNS_UFuayGXIvzz9FG00QIk";                   
$ssl_ca   = __DIR__ . "/../ca.pem";                     

try {
    $options = [
        PDO::MYSQL_ATTR_SSL_CA => $ssl_ca,
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ];

    $conn = new PDO("mysql:host=$host;port=$port;dbname=$dbname;charset=utf8", $username, $pass, $options);

} catch (PDOException $e) {
    die("Error al conectar: " . $e->getMessage());
}
?>