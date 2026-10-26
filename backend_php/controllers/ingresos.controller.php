<?php

require_once __DIR__ . '/../models/ingresos.model.php';

function getAllIngresos() {
  $ingresos = getIngresosModel();
  echo json_encode($ingresos);
}

function createIngreso($data) {
  $result = setIngresosModel($data);
  if ($result) {
    echo json_encode(['message' => 'Ingreso creado exitosamente']);
  } else {
    echo json_encode(['message' => 'Error al crear el ingreso']);
  }
}
?>
