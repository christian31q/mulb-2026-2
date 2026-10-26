<?php
require_once __DIR__ . '/../database/connection.php';

global $conn;

function getIngresosModel() {
  global $conn;

  try {
    $query = "SELECT * FROM ingresos";
    $stmt = $conn->query($query);
    $ingresos = [];
    while ($row = $stmt->fetch_assoc()) {
      $ingresos[] = $row;
    }
    return $ingresos ?? [];
  } catch (PDOException $e) {
    return false;
  }
}

function setIngresosModel($data) {
  global $conn;

  /*
  nombre
valor
fecha
categoria
  */

  try {
    $query = "INSERT INTO ingresos (nombre, valor, fecha, categoria) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssss", $data['nombre'], $data['valor'], $data['fecha'], $data['categoria']);
    if ($stmt->execute()) {
      return true;
    } else {
      return false;
    }
  } catch (PDOException $e) {
    return false;
  }
}

?>
