<?php
require("conn.php"); 
$stmt = $conn->prepare("SELECT * FROM productos");
$stmt->execute();
$productos = $stmt->fetchAll();
echo json_encode($productos);
?>

