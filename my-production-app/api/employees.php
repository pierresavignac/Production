<?php
require_once 'config.php';

// Activer l'affichage des erreurs dans le log
ini_set('log_errors', 1);
ini_set('error_log', __DIR__ . '/debug.log');

// Appliquer les headers CORS standardisés
setCorsHeaders();

// Gérer les requêtes OPTIONS
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

try {
    // Pagination
    $page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
    $limit = isset($_GET['limit']) ? min(50, max(1, intval($_GET['limit']))) : 20;
    $offset = ($page - 1) * $limit;
    
    $stmt = $pdo->prepare("
        SELECT 
            id,
            first_name,
            last_name,
            CONCAT(first_name, ' ', last_name) as full_name,
            role
        FROM employees
        ORDER BY last_name ASC, first_name ASC
        LIMIT :limit OFFSET :offset
    ");
    
    $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();
    
    $employees = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo json_encode([
        'success' => true,
        'data' => $employees,
        'pagination' => [
            'page' => $page,
            'limit' => $limit,
            'total' => $pdo->query("SELECT COUNT(*) FROM employees")->fetchColumn()
        ]
    ], JSON_UNESCAPED_UNICODE);

} catch(Exception $e) {
    error_log("Erreur dans employees.php : " . $e->getMessage());
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => "Erreur serveur",
        'details' => $e->getMessage()
    ], JSON_UNESCAPED_UNICODE);
} 