<?php
require_once 'config.php';
setCorsHeaders();

// Activer l'affichage des erreurs dans le log
ini_set('display_errors', 1);
error_reporting(E_ALL);
ini_set('log_errors', 1);
ini_set('error_log', __DIR__ . '/debug.log');

// Gérer les requêtes OPTIONS
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

try {
    // Vérifier la connexion
    if (!isset($pdo)) {
        throw new Exception("La connexion à la base de données n'est pas établie");
    }

    // Vérifier si la colonne is_technician existe
    $stmt = $pdo->query("SHOW COLUMNS FROM employees LIKE 'is_technician'");
    $columnExists = $stmt->fetch();

    if (!$columnExists) {
        // Ajouter la colonne si elle n'existe pas
        $pdo->exec("ALTER TABLE employees ADD COLUMN is_technician BOOLEAN NOT NULL DEFAULT FALSE");
        
        // Marquer les techniciens existants
        $pdo->exec("UPDATE employees SET is_technician = TRUE WHERE 
            (first_name = 'Luis' AND last_name = 'Becerra') OR 
            (first_name = 'Jonathan' AND last_name = 'Diaz') OR 
            (first_name = 'Thierry' AND last_name = 'Menard') OR 
            (first_name = 'Yvon-Pierre' AND last_name = 'Menard') OR 
            (first_name = 'Jean-François' AND last_name = 'Sauvé') OR 
            (first_name = 'Patrice' AND last_name = 'Tremblay') OR 
            (first_name = 'Benoit' AND last_name = 'Trembly') OR 
            (first_name = 'Pascal' AND last_name = 'Pascal')");
    }

    // Récupérer le type de requête (tous les employés ou seulement les techniciens)
    $type = isset($_GET['type']) ? $_GET['type'] : 'all';

    // Préparer la requête en fonction du type
    if ($type === 'technicians') {
        $query = "
            SELECT 
                id,
                first_name,
                last_name,
                CONCAT(first_name, ' ', last_name) as full_name,
                COALESCE(is_technician, FALSE) as is_technician
            FROM employees
            WHERE active = 1 AND COALESCE(is_technician, FALSE) = TRUE
            ORDER BY last_name ASC, first_name ASC
        ";
    } else {
        $query = "
            SELECT 
                id,
                first_name,
                last_name,
                CONCAT(first_name, ' ', last_name) as full_name,
                COALESCE(is_technician, FALSE) as is_technician
            FROM employees
            WHERE active = 1
            ORDER BY last_name ASC, first_name ASC
        ";
    }

    error_log("Exécution de la requête: " . $query);
    
    $stmt = $pdo->query($query);
    
    if (!$stmt) {
        throw new Exception("Erreur lors de l'exécution de la requête");
    }
    
    $employees = $stmt->fetchAll(PDO::FETCH_ASSOC);
    error_log("Nombre d'employés trouvés: " . count($employees));
    
    // Renvoyer directement le tableau des employés
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($employees, JSON_UNESCAPED_UNICODE);

} catch(Exception $e) {
    error_log("Erreur dans employees.php : " . $e->getMessage());
    error_log("Trace : " . $e->getTraceAsString());
    
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => "Erreur serveur",
        'details' => $e->getMessage()
    ], JSON_UNESCAPED_UNICODE);
} 