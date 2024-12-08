<?php
// Activation du reporting d'erreurs pour le débogage
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Configuration de la base de données
define('DB_HOST', 'localhost');
define('DB_NAME', 'vivreenl_prod_calendar');
define('DB_USER', 'vivreenl_username_prod_calendar');
define('DB_PASS', 'pachYv-9mybmo-bagmeh');

// Configuration CORS commune
define('CORS_ORIGIN', '*');

// Fonction commune pour les headers CORS
function setCorsHeaders() {
    if (isset($_SERVER['HTTP_ORIGIN'])) {
        header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
    } else {
        header('Access-Control-Allow-Origin: *');
    }
    
    header('Access-Control-Allow-Credentials: true');
    header('Access-Control-Max-Age: 86400');    // cache pour 1 jour
    header('Content-Type: application/json; charset=utf-8');

    // Gérer les requêtes OPTIONS pour le preflight
    if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD'])) {
            header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
        }
        
        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS'])) {
            header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
        }
        exit(0);
    }
}

try {
    $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4";
    
    $pdo = new PDO($dsn, DB_USER, DB_PASS, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4"
    ]);
    
} catch(PDOException $e) {
    error_log("Erreur de connexion : " . $e->getMessage());
    http_response_code(500);
    echo json_encode(['error' => 'Erreur de connexion à la base de données']);
    exit;
}
?> 