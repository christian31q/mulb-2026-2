<?php
require_once __DIR__ . '/../models/productos.model.php';


function getAllProductos() {
  $productos = getProductosModel();
  echo json_encode($productos);
}

function setProducto($categoria, $descripcion, $precio, $imagen, $marca, $color, $talla) {
  $result = setProductoModel($categoria, $descripcion, $precio, $imagen, $marca, $color, $talla);
  echo json_encode(['success' => $result]);
}

?>
