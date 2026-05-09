<?php
require_once __DIR__ . '/../config/Database.php';

class ProductoServicio {
    private PDO $conn;

    public function __construct() {
        $this->conn = (new Database())->connect();
    }

    public function activosPorTipo(string $tipo): array {
        $sql = 'SELECT * FROM productos_servicios WHERE tipo = :tipo AND activo = 1 ORDER BY precio ASC';
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['tipo' => $tipo]);
        return $stmt->fetchAll();
    }

    public function todosActivos(): array {
        return $this->conn->query('SELECT * FROM productos_servicios WHERE activo = 1 ORDER BY tipo, nombre')->fetchAll();
    }

    public function buscarPorId(int $id): ?array {
        $stmt = $this->conn->prepare('SELECT * FROM productos_servicios WHERE id = :id AND activo = 1');
        $stmt->execute(['id' => $id]);
        $row = $stmt->fetch();
        return $row ?: null;
    }
}
