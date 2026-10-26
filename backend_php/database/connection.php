<?php

$databasePassword = getenv('SUPABASE_DB_PASSWORD');

if (!$databasePassword) {
  http_response_code(500);
  header('Content-Type: application/json; charset=utf-8');
  echo json_encode(['error' => 'Falta configurar SUPABASE_DB_PASSWORD.']);
  exit;
}

try {
  $host = getenv('SUPABASE_DB_HOST') ?: 'db.xuzfixguuqepfllakeng.supabase.co';
  $port = getenv('SUPABASE_DB_PORT') ?: '5432';
  $database = getenv('SUPABASE_DB_NAME') ?: 'postgres';
  $user = getenv('SUPABASE_DB_USER') ?: 'postgres';
  $dsn = "pgsql:host=$host;port=$port;dbname=$database;sslmode=require";

  $conn = new PDO($dsn, $user, $databasePassword, [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
  ]);
} catch (PDOException $error) {
  error_log('No se pudo conectar con Supabase: ' . $error->getMessage());
  http_response_code(500);
  header('Content-Type: application/json; charset=utf-8');
  echo json_encode(['error' => 'No se pudo conectar con la base de datos.']);
  exit;
}
