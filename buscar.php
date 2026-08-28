<?php
require("conn.php");


$palabra = trim($_GET["searchProduct"] ?? '');
$categoria = trim($_GET["categoria"] ?? '');
$vendido = trim($_GET["masvendido"] ?? '');
$params = [];
$sql = "CALL listar_productos()";
$titulo = "INICIO";

if ($palabra) {
    $sql = "CALL busqueda(?)";
    $params = ["%" . $palabra . "%"];
    $titulo = "Relacionado con: ".$palabra;
}

if($categoria){
    $sql = "CALL categoria(?)";
    $params = [$categoria];
    $titulo = $categoria;
}

if($vendido){
    $sql = "CALL ord_cant()";
    $titulo = "Mas vendidos";
}




$stmt = $conn->prepare($sql);
$stmt->execute($params);
$productos = $stmt->fetchAll();
?>