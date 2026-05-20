CREATE DATABASE IF NOT EXISTS quinta_dalam CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE quinta_dalam;

DROP TABLE IF EXISTS reservaciones;
DROP TABLE IF EXISTS usuarios;
DROP TABLE IF EXISTS productos_servicios;
DROP TABLE IF EXISTS roles;

CREATE TABLE roles (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(50) NOT NULL UNIQUE
);

CREATE TABLE usuarios (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(100) NOT NULL,
  email VARCHAR(100) UNIQUE NOT NULL,
  password_hash VARCHAR(255) NOT NULL,
  rol_id INT NOT NULL,
  tipo_usuario ENUM('admin','empleado','cliente') NOT NULL,
  FOREIGN KEY (rol_id) REFERENCES roles(id)
);

CREATE TABLE productos_servicios (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(120) NOT NULL,
  tipo ENUM('producto','servicio','habitacion') NOT NULL,
  descripcion TEXT NOT NULL,
  precio DECIMAL(10,2) NOT NULL,
  capacidad INT DEFAULT NULL,
  activo TINYINT DEFAULT 1
);

CREATE TABLE reservaciones (
  id INT AUTO_INCREMENT PRIMARY KEY,
  usuario_id INT NULL,
  producto_servicio_id INT NOT NULL,
  checkin DATE NOT NULL,
  checkout DATE NOT NULL,
  huespedes INT NOT NULL,
  tipo_cama VARCHAR(50) NOT NULL,
  nombre_huesped VARCHAR(100) NOT NULL,
  apellido_huesped VARCHAR(100) NOT NULL,
  correo VARCHAR(100) NOT NULL,
  telefono VARCHAR(30) NOT NULL,
  direccion VARCHAR(180) NULL,
  metodo_pago VARCHAR(50) NOT NULL,
  referencia VARCHAR(80) NULL,
  comentarios TEXT NULL,
  creado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE SET NULL,
  FOREIGN KEY (producto_servicio_id) REFERENCES productos_servicios(id)
);

INSERT INTO roles(nombre) VALUES ('admin'), ('empleado'), ('cliente');

INSERT INTO usuarios(nombre, email, password_hash, rol_id, tipo_usuario) VALUES
('Administrador', 'admin@quintadalam.com', '$2y$10$Y/T8JQ6n8AhwKtstZLp7TefhLXlYYw0nYCN6lSAjrgY4VME2nL7r6', 1, 'admin');
-- Password admin: Admin12345

INSERT INTO productos_servicios(nombre, tipo, descripcion, precio, capacidad) VALUES
('Habitacion Tzintzuntzan','habitacion','Ambiente calido con detalles artesanales.',1450,2),
('Habitacion Paracho','habitacion','Inspirada en la madera y la musica tradicional.',1500,2),
('Habitacion Yunuen','habitacion','Estancia serena con estilo fresco y relajante.',1620,3),
('Habitacion Patzcuaro','habitacion','Diseno elegante con acentos tradicionales.',1750,3),
('Habitacion Janitzio','habitacion','Habitacion intima y sofisticada para parejas.',1880,2),
('Suite Quencio','habitacion','Suite amplia para familias o grupos.',2400,4),
('Desayuno regional','servicio','Servicio de desayuno con platillos regionales.',250,NULL),
('Decoracion romantica','servicio','Decoracion especial para aniversario o pareja.',600,NULL),
('Tour local','servicio','Recorrido turistico por la zona.',900,NULL);
