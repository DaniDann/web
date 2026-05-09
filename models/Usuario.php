<?php
require_once __DIR__ . '/../config/Database.php';

class Usuario {
    private PDO $conn;

    public function __construct() {
        $this->conn = (new Database())->connect();
    }

    public function todos(): array {
        return $this->conn->query('SELECT u.id, u.nombre, u.email, u.tipo_usuario, r.nombre AS rol FROM usuarios u INNER JOIN roles r ON u.rol_id = r.id ORDER BY u.id DESC')->fetchAll();
    }

    public function buscar(int $id): ?array {
        $stmt = $this->conn->prepare('SELECT * FROM usuarios WHERE id = :id');
        $stmt->execute(['id' => $id]);
        $row = $stmt->fetch();
        return $row ?: null;
    }

    public function buscarPorEmail(string $email): ?array {
        $stmt = $this->conn->prepare('SELECT u.*, r.nombre AS rol FROM usuarios u INNER JOIN roles r ON u.rol_id = r.id WHERE u.email = :email');
        $stmt->execute(['email' => $email]);
        $row = $stmt->fetch();
        return $row ?: null;
    }

    public function crear(string $nombre, string $email, string $password, int $rolId, string $tipoUsuario): void {
        $sql = 'INSERT INTO usuarios(nombre, email, password_hash, rol_id, tipo_usuario) VALUES(:nombre, :email, :password_hash, :rol_id, :tipo_usuario)';
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            'nombre' => $nombre,
            'email' => $email,
            'password_hash' => password_hash($password, PASSWORD_DEFAULT),
            'rol_id' => $rolId,
            'tipo_usuario' => $tipoUsuario
        ]);
    }

    public function actualizar(int $id, string $nombre, string $email, int $rolId, string $tipoUsuario, ?string $password = null): void {
        if ($password) {
            $sql = 'UPDATE usuarios SET nombre=:nombre, email=:email, rol_id=:rol_id, tipo_usuario=:tipo_usuario, password_hash=:password_hash WHERE id=:id';
            $params = ['nombre'=>$nombre,'email'=>$email,'rol_id'=>$rolId,'tipo_usuario'=>$tipoUsuario,'password_hash'=>password_hash($password, PASSWORD_DEFAULT),'id'=>$id];
        } else {
            $sql = 'UPDATE usuarios SET nombre=:nombre, email=:email, rol_id=:rol_id, tipo_usuario=:tipo_usuario WHERE id=:id';
            $params = ['nombre'=>$nombre,'email'=>$email,'rol_id'=>$rolId,'tipo_usuario'=>$tipoUsuario,'id'=>$id];
        }
        $this->conn->prepare($sql)->execute($params);
    }

    public function eliminar(int $id): void {
        $stmt = $this->conn->prepare('DELETE FROM usuarios WHERE id = :id');
        $stmt->execute(['id' => $id]);
    }
}
