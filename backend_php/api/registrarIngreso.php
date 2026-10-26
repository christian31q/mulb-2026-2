<?php
require_once __DIR__ . '/../controllers/ingresos.controller.php';

// Set headers
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');
header('Content-Type: application/json; charset=utf-8');

/*
createIngreso
Post data:
{
  "nombre": "Venta de producto X",
  "valor": "100.00",
  "fecha": "2024-06-01",
  "categoria": "Ventas"
}
*/
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $data = json_decode(file_get_contents('php://input'), true);
  createIngreso($data);
} 
?>
