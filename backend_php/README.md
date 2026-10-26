# Backend PHP y Supabase

El endpoint `api/paseadores.php` consulta `public.paseadores` en el proyecto
Supabase `mulB` y devuelve los resultados como JSON para el frontend.

## Configuración

Configura estas variables en el entorno que ejecuta PHP. No guardes la
contraseña en el repositorio:

| Variable | Valor |
| --- | --- |
| `SUPABASE_DB_HOST` | `aws-1-us-east-2.pooler.supabase.com` |
| `SUPABASE_DB_PORT` | `5432` |
| `SUPABASE_DB_NAME` | `postgres` |
| `SUPABASE_DB_USER` | `postgres.xuzfixguuqepfllakeng` |
| `SUPABASE_DB_PASSWORD` | Contraseña de la base de datos del proyecto Supabase |

Se usa el pooler de sesión de Supabase porque el host directo
(`db.<ref>.supabase.co`) solo admite IPv6 y falla en Render y en muchas redes.

Para desarrollo local, completa `backend_php/.env`; PHP lo carga
automáticamente. Escribe el valor de la contraseña entre comillas dobles si
contiene caracteres especiales. El archivo está excluido de Git y Docker. En
Render, define las variables en la configuración del servicio.

La conexión requiere TLS (`sslmode=require`) y la extensión PDO PostgreSQL.
La imagen Docker del backend instala `pdo_pgsql`.

## Despliegue en Render

Crea un servicio **Web Service** usando Docker y configura `backend_php` como
**Root Directory**, de modo que Render encuentre este Dockerfile y use esa
carpeta como contexto de compilación. Render asigna `PORT` automáticamente; la
imagen escucha en `0.0.0.0` y usa `10000` como valor predeterminado local.
Agrega `SUPABASE_DB_PASSWORD` en las variables de entorno del servicio.

## Endpoint

`GET /api/paseadores.php` devuelve los paseadores. La página debe servirse
desde un servidor web con PHP; abrir `index.html` directamente como archivo no
ejecuta el endpoint.
