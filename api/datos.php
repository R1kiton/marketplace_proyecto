<?php
require("conn.php");

$busqueda = trim($_GET['busqueda'] ?? '');
if ($busqueda === '') {
    $busqueda = null;
}

$categoriaParam = $_GET['categoria'] ?? null;
$categorias = (is_array($categoriaParam) && count($categoriaParam) > 0) ? implode(',', $categoriaParam) : null;

$precio_min = ($_GET['precio_min'] ?? '') !== '' ? (float) $_GET['precio_min'] : null;
$precio_max = ($_GET['precio_max'] ?? '') !== '' ? (float) $_GET['precio_max'] : null;
$calificacion = ($_GET['calificacion'] ?? '') !== '' ? (float) $_GET['calificacion'] : null;
$vendidos = ($_GET['vendidos'] ?? '') !== '' ? (int) $_GET['vendidos'] : null;
$envio_gratis = ($_GET['envio_gratis'] ?? null) == '1' ? 1 : null;

$stmt = $conn->prepare("CALL sp_filtrar_productos(?, ?, ?, ?, ?, ?, ?)");

$stmt->execute([$busqueda,$categorias,$precio_min,$precio_max,$calificacion,$vendidos,$envio_gratis]);

$productos = $stmt->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($productos);
?>
