<?php
require_once __DIR__ . '/../database/connection.php';

global $conn;



function getProductosModel() {
  global $conn;

  try {
    $query = "SELECT * FROM productos";
    $stmt = $conn->query($query);
    while ($row = $stmt->fetch_assoc()) {
      $productos[] = $row;
    }
    return $productos;
  } catch (PDOException $e) {
    return false;
  }
}

function setProductoModel($categoria, $descripcion, $precio, $imagen, $marca, $color, $talla) {
  global $conn;
/*
 "id"
    "categoria"
    "descripcion"
    "precio"
    "imagen"
    "marca"
    "color"
    "talla"
*/
  try {
    $query = "INSERT INTO productos (categoria, descripcion, precio, imagen, marca, color, talla) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param($categoria, $descripcion, $precio, $imagen, $marca, $color, $talla);
    $stmt->execute();
    return true;
  } catch (PDOException $e) {
    return false;
  }
}

?>
