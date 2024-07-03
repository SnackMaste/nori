<?php
// conexion.php
class Database {
    private static $instance = null;
    private $conn;

    private function __construct() {
        $host = 'johnny.heliohost.org';
        $user = 'howl_nori_user';
        $pass = 'Sayonarahowl1998?';
        $db = 'howl_NoriDB';
        $charset = 'utf8mb4';
        $port = 3306;

        $dsn = "mysql:host=$host;dbname=$db;charset=$charset;port=$port";
        try {
            $this->conn = new PDO($dsn, $user, $pass);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            echo 'Error de conexión: ' . $e->getMessage();
        }
    }

    public static function getInstance() {
        if (!self::$instance) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    public function getConnection() {
        return $this->conn;
    }
}



