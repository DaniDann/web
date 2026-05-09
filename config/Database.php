<?php
class Database {
    private string $host = 'localhost';
    private string $dbname = 'quinta_dalam';
    private string $username = 'root';
    private string $password = '';

    public function connect(): PDO {
        try {
            $conn = new PDO(
                "mysql:host={$this->host};dbname={$this->dbname};charset=utf8mb4",
                $this->username,
                $this->password,
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES => false,
                ]
            );
            return $conn;
        } catch (PDOException $e) {
            die('Error de conexion a la base de datos. Revisa config/Database.php');
        }
    }
}
