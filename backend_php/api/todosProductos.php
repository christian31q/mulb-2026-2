<?php
require_once __DIR__ . '/../controllers/productos.controller.php';
header('Content-Type: application/json');
// Set headers
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');
header('Content-Type: application/json; charset=utf-8');

getAllProductos();
?>
