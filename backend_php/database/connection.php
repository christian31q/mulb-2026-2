<?php

$environmentFile = __DIR__ . '/../.env';

if (is_file($environmentFile)) {
  $environment = parse_ini_file($environmentFile, false, INI_SCANNER_RAW);

  if ($environment === false) {
    http_response_code(500);
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode(['error' => 'No se pudo leer el archivo de configuración.']);
    exit;
  }

  foreach ($environment as $name => $value) {
    if (getenv($name) === false) {
      putenv("$name=$value");
    }
  }
}

$databasePassword = getenv('SUPABASE_DB_PASSWORD');

if (!$databasePassword) {
  http_response_code(500);
  header('Content-Type: application/json; charset=utf-8');
  echo json_encode(['error' => 'Falta configurar SUPABASE_DB_PASSWORD.']);
  exit;
}

try {
  $host = getenv('SUPABASE_DB_HOST') ?: 'aws-1-us-east-2.pooler.supabase.com';
  $port = getenv('SUPABASE_DB_PORT') ?: '5432';
  $database = getenv('SUPABASE_DB_NAME') ?: 'postgres';
  $user = getenv('SUPABASE_DB_USER')   ?: 'postgres.xuzfixguuqepfllakeng';
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
