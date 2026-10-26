# Backend PHP y Supabase

El endpoint `api/paseadores.php` consulta `public.paseadores` en el proyecto
Supabase `mulB` y devuelve los resultados como JSON para el frontend.

## Configuración

Configura estas variables en el entorno que ejecuta PHP. No guardes la
contraseña en el repositorio:

| Variable | Valor |
| --- | --- |
| `SUPABASE_DB_HOST` | `db.xuzfixguuqepfllakeng.supabase.co` |
| `SUPABASE_DB_PORT` | `5432` |
| `SUPABASE_DB_NAME` | `postgres` |
| `SUPABASE_DB_USER` | `postgres` |
| `SUPABASE_DB_PASSWORD` | Contraseña de la base de datos del proyecto Supabase |

La conexión requiere TLS (`sslmode=require`) y la extensión PDO PostgreSQL.
La imagen Docker del backend instala `pdo_pgsql`.

## Endpoint

`GET /backend_php/api/paseadores.php` devuelve los paseadores. La página debe
servirse desde un servidor web con PHP; abrir `index.html` directamente como
archivo no ejecuta el endpoint.
