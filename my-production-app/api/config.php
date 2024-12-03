<?php
// Configuration de la base de données
define('DB_HOST', 'localhost');
define('DB_USER', 'vivreenl_username_prod_calendar');
define('DB_PASS', 'pachYv-9mybmo-bagmeh');
define('DB_NAME', 'vivreenl_prod_calendar');

// Configuration CORS commune
define('CORS_ORIGIN', '*');  // Temporairement pour le débogage

// Fonction commune pour les headers CORS
function setCorsHeaders() {
    header('Content-Type: application/json; charset=utf-8');
    header('Access-Control-Allow-Origin: ' . CORS_ORIGIN);
    header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
    header('Access-Control-Allow-Headers: Content-Type, Authorization');
    header('Access-Control-Allow-Credentials: true');
}

try {
    $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4";
    error_log("Tentative de connexion à la base de données avec DSN: " . $dsn);
    
    $pdo = new PDO($dsn, DB_USER, DB_PASS, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4"
    ]);
    
    error_log("Connexion à la base de données réussie");
} catch(PDOException $e) {
    error_log("Erreur de connexion PDO : " . $e->getMessage());
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => "Erreur de connexion à la base de données",
        'details' => $e->getMessage()
    ]);
    exit;
} 