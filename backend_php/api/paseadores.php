<?php
require_once __DIR__ . '/../database/connection.php';

header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Methods: GET, OPTIONS');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
  http_response_code(204);
  exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
  header('Allow: GET, OPTIONS');
  http_response_code(405);
  echo json_encode(['error' => 'Método no permitido.']);
  exit;
}

try {
  $query = $conn->query(
    "SELECT name, status, rating, review_count AS \"reviewCount\", location, description, price,
            (EXTRACT(EPOCH FROM duration)::integer / 60)::text || ' min' AS duration
     FROM public.paseadores
     ORDER BY rating DESC, id"
  );
  $walkers = $query->fetchAll();

  foreach ($walkers as &$walker) {
    $walker['rating'] = (float) $walker['rating'];
    $walker['reviewCount'] = (int) $walker['reviewCount'];
    $walker['price'] = '$' . number_format((float) $walker['price'], 0, ',', '.');
  }
  unset($walker);

  echo json_encode($walkers, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
} catch (PDOException $error) {
  error_log('No se pudieron cargar los paseadores: ' . $error->getMessage());
  http_response_code(500);
  echo json_encode(['error' => 'No se pudieron cargar los paseadores.']);
}
