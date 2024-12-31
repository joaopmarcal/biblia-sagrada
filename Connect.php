<?php

class Connect {

    private $host = 'localhost';
    private $dbname = 'bible';
    private $username = 'root';
    private $password = 'lkoperu89074563';

    private static $instance = null; // Instância única da classe (Singleton)
    private $connection; // Conexão PDO

    private function __construct() {
        try {
            // Criar a conexão com o banco de dados
            $this->connection = new PDO(
                "mysql:host={$this->host};dbname={$this->dbname};charset=utf8mb4",
                $this->username,
                $this->password
            );
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Erro ao conectar ao banco de dados: " . $e->getMessage());
        }
    }

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new Connect();
        }
        return self::$instance;
    }

    public function getConnection() {
        return $this->connection;
    }
}
?>
