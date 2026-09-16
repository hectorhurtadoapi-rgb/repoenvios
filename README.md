# Sistema de Gestión de Envíos

Aplicativo sencillo desarrollado con PHP + MySQL para gestionar envíos mediante un CRUD.

## Campos del envío

- ID
- Destinatario
- Dirección
- Descripción
- Fecha de creación

## Base de datos

- Host MySQL: `mysql-hectorapi.alwaysdata.net`
- Usuario: `hectorapi`
- Base de datos: `hectorapi_repoenvios`

La tabla `envios` se crea automáticamente desde `config.php` si todavía no existe.

## Archivos

- `index.html`: interfaz web del CRUD.
- `api.php`: API REST.
- `config.php`: conexión a MySQL y creación automática de la tabla.
- `README.md`: documentación.

## Endpoints

### Listar envíos

`GET /api.php`

### Crear envío

`POST /api.php`

JSON:

```json
{
  "destinatario": "Juan Pérez",
  "direccion": "Calle 10 # 20-30",
  "descripcion": "Paquete de documentos"
}
```

### Actualizar envío

`PUT /api.php`

JSON:

```json
{
  "id": 1,
  "destinatario": "Juan Pérez",
  "direccion": "Calle 10 # 20-30",
  "descripcion": "Paquete actualizado"
}
```

### Eliminar envío

`DELETE /api.php?id=1`

## Instalación en AlwaysData

1. Sube los archivos al espacio web.
2. Verifica que el servidor tenga PHP y PDO MySQL habilitados.
3. Abre `index.html` desde tu dominio.
4. Al ejecutar el aplicativo, `config.php` crea la tabla `envios` automáticamente si no existe.

## Nota sobre el host

La dirección web `https://hectorapi.alwaysdata.net/` es el sitio web. Para la conexión PHP a MySQL se utiliza el host MySQL:

`mysql-hectorapi.alwaysdata.net`
