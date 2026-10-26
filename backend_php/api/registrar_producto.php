<?php
require_once __DIR__ . '/../controllers/productos.controller.php';
header('Content-Type: application/json');
// Set headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");


// Registrar producto
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $data = json_decode(file_get_contents('php://input'), true);
  setProducto(
    $data['categoria'],
    $data['descripcion'],
    $data['precio'],
    $data['imagen'],
    $data['marca'],
    $data['color'],
    $data['talla']
  );
}


?>