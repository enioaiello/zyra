<?php
namespace App\Core;

use PDO;
use PDOException;

class EntityManager {
    private $pdo; // Instance de PDO pour la connexion à la base de données

    public function __construct() {
        $this->connect();
    }

    private function connect() {
        // Connexion à la base de données avec les variables d'environnement
        $dsn = "mysql:host=" . getenv('DB_HOST') . ";dbname=" . getenv('DB_NAME') . ";charset=utf8";
        try {
            $this->pdo = new PDO($dsn, getenv('DB_USER'), getenv('DB_PASS'), [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // Active les erreurs PDO
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC // Récupère les résultats sous forme de tableau associatif
            ]);
        } catch (PDOException $e) {
            die("Erreur de connexion à la base de données : " . $e->getMessage());
        }
    }

    public function query(string $sql, array $params = []) {
        // Prépare et exécute une requête SQL avec paramètres
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    }

    public function findOne(string $table, string $where, array $params = []) {
        // Récupère un seul enregistrement
        $sql = "SELECT * FROM $table WHERE $where LIMIT 1";
        return $this->query($sql, $params)->fetch();
    }

    public function findAll(string $table, string $orderBy = "id DESC") {
        // Récupère tous les enregistrements d'une table
        $sql = "SELECT * FROM $table ORDER BY $orderBy";
        return $this->query($sql)->fetchAll();
    }

    public function insert(string $table, array $data) {
        // Insère un nouvel enregistrement
        $columns = implode(", ", array_keys($data));
        $placeholders = implode(", ", array_map(fn($key) => ":$key", array_keys($data)));
        $sql = "INSERT INTO $table ($columns) VALUES ($placeholders)";
        $this->query($sql, $data);
        return $this->pdo->lastInsertId(); // Retourne l'ID du dernier enregistrement inséré
    }

    public function update(string $table, array $data, string $where, array $params = []) {
        // Met à jour un enregistrement
        $set = implode(", ", array_map(fn($key) => "$key = :$key", array_keys($data)));
        $sql = "UPDATE $table SET $set WHERE $where";
        $this->query($sql, array_merge($data, $params));
    }

    public function delete(string $table, string $where, array $params = []) {
        // Supprime un enregistrement
        $sql = "DELETE FROM $table WHERE $where";
        $this->query($sql, $params);
    }
}
