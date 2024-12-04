<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');
header('Content-Type: application/json');

require_once 'config.php';

// Gestion des requêtes OPTIONS (pre-flight)
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

try {
    // Utilisation des constantes définies dans config.php
    $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4";
    $pdo = new PDO($dsn, DB_USER, DB_PASS, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4"
    ]);

    // Si on demande les régions
    if (isset($_GET['type']) && $_GET['type'] === 'regions') {
        $stmt = $pdo->query("SELECT * FROM regions ORDER BY name");
        $regions = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($regions);
    }
    // Si on demande les villes d'une région spécifique
    else if (isset($_GET['region_id'])) {
        $stmt = $pdo->prepare("SELECT * FROM cities WHERE region_id = ? ORDER BY name");
        $stmt->execute([$_GET['region_id']]);
        $cities = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($cities);
    }
    // Si aucun paramètre n'est spécifié, retourner toutes les villes
    else {
        $stmt = $pdo->query("SELECT * FROM cities ORDER BY name");
        $cities = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($cities);
    }

} catch(PDOException $e) {
    error_log("Erreur dans regions.php : " . $e->getMessage());
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
} 