# Quinta Dalam - Programación del Lado del Servidor

Proyecto desarrollado para la **Práctica Unidad 4 - Programación del Lado del Servidor**.

## Descripción

Quinta Dalam es una aplicación web para la administración de habitaciones y reservaciones de un hotel temático.

El sistema incluye:

- Gestión de usuarios
- Inicio de sesión
- Roles y permisos
- Reservaciones conectadas a base de datos
- Consulta dinámica mediante AJAX
- Sesiones de usuario
- Conexión segura HTTPS mediante ngrok

---

# Tecnologías utilizadas

- PHP 8
- MySQL / MariaDB
- XAMPP
- HTML5
- CSS3
- JavaScript
- AJAX (Fetch API)
- GitHub
- ngrok (HTTPS)

---

# Requisitos

- XAMPP
- PHP 8+
- MySQL/MariaDB
- Navegador web
- Git (opcional)

---

# Instalación

## 1. Clonar repositorio

```bash
git clone https://github.com/DaniDann/web.git
```

o descargar ZIP.

---

## 2. Mover proyecto

Mover carpeta:

```txt
web
```

a:

```txt
C:\xampp\htdocs\
```

---

## 3. Iniciar XAMPP

Encender:

- Apache
- MySQL

---

## 4. Crear base de datos

Abrir:

```txt
http://localhost/phpmyadmin
```

Crear base de datos:

```txt
quinta_dalam
```

Importar archivo:

```txt
database.sql
```

---

## 5. Configurar conexión

Archivo:

```txt
config/Database.php
```

Configuración utilizada:

```php
private $host = 'localhost';
private $db_name = 'quinta_dalam';
private $username = 'root';
private $password = '';
```

---

# Ejecución del proyecto

Abrir:

```txt
http://localhost/web/index.php
```

---

# Usuario administrador

```txt
Correo:
admin@quintadalam.com

Contraseña:
Admin12345
```

---

# Funcionalidades implementadas

## Paso 1

✅ Clase de conexión a base de datos  
✅ Mostrar productos y servicios desde MySQL  
✅ Diseño y manejo de eventos

---

## Paso 2

✅ CRUD de usuarios  
✅ Roles y tipos de usuario  
✅ Contraseñas cifradas con `password_hash()`

---

## Paso 3

✅ Formularios conectados a base de datos  
✅ Reservaciones almacenadas en MySQL  
✅ AJAX para consulta dinámica de habitaciones  
✅ Sesiones de navegador

---

## Paso 4

✅ Validación HTML/CSS  
✅ Commits en GitHub  
✅ HTTPS mediante ngrok

---

# AJAX implementado

Se implementó AJAX usando:

```txt
assets/js/ajax-habitacion.js
```

y:

```txt
api/buscar_habitacion.php
```

Permite consultar información de habitaciones sin recargar la página.

---

# HTTPS

El proyecto fue probado mediante HTTPS utilizando ngrok.

Comando utilizado:

```bash
ngrok http 80
```

URL HTTPS de ejemplo:

```txt
https://victory-affront-take.ngrok-free.dev/web/index.php
```

---

# Estructura del proyecto

```txt
WEB
│
├── admin
├── api
├── assets
│   └── js
├── config
├── includes
├── models
├── styles.css
├── index.php
├── login.php
├── logout.php
├── reservaciones.php
├── habitaciones.php
└── database.sql
```

---

# Autor

Proyecto desarrollado por:

```txt
DaniDann
```

Materia:

```txt
Programación Web
```
