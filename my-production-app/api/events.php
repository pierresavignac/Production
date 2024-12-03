<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once 'config.php';

// Log pour le débogage
error_log("Début de la requête events.php");

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
    // Test de connexion
    $pdo->query("SELECT 1");
    error_log("Connexion à la base de données réussie");

    // Récupération des événements avec pagination
    $page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
    $limit = isset($_GET['limit']) ? min(50, max(1, intval($_GET['limit']))) : 20;
    $offset = ($page - 1) * $limit;
    
    error_log("Exécution de la requête avec page=$page, limit=$limit");
    
    $stmt = $pdo->prepare("
        SELECT 
            e.*,
            CONCAT(emp.first_name, ' ', emp.last_name) as employee_name,
            CONCAT(t1.first_name, ' ', t1.last_name) as technician1_name,
            CONCAT(t2.first_name, ' ', t2.last_name) as technician2_name,
            CONCAT(t3.first_name, ' ', t3.last_name) as technician3_name,
            CONCAT(t4.first_name, ' ', t4.last_name) as technician4_name,
            r.name as region_name
        FROM events e
        LEFT JOIN employees emp ON e.employee_id = emp.id
        LEFT JOIN employees t1 ON e.technician1_id = t1.id
        LEFT JOIN employees t2 ON e.technician2_id = t2.id
        LEFT JOIN employees t3 ON e.technician3_id = t3.id
        LEFT JOIN employees t4 ON e.technician4_id = t4.id
        LEFT JOIN regions r ON e.region_id = r.id
        ORDER BY e.date ASC, e.installation_time ASC
        LIMIT :limit OFFSET :offset
    ");
    
    $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();
    
    $events = $stmt->fetchAll(PDO::FETCH_ASSOC);
    error_log("Nombre d'événements trouvés : " . count($events));
    
    // Formater les événements
    $formattedEvents = array_map(function($event) {
        return [
            'id' => $event['id'] ?? null,
            'date' => $event['date'] ?? null,
            'installation_time' => $event['installation_time'] ?? null,
            'type' => $event['type'] ?? null,
            'first_name' => $event['first_name'] ?? '',
            'last_name' => $event['last_name'] ?? '',
            'installation_number' => $event['installation_number'] ?? '',
            'city' => $event['city'] ?? '',
            'equipment' => $event['equipment'] ?? '',
            'amount' => $event['amount'] ?? null,
            'employee_name' => $event['employee_name'] ?? '',
            'technician1_name' => $event['technician1_name'] ?? '',
            'technician2_name' => $event['technician2_name'] ?? '',
            'technician3_name' => $event['technician3_name'] ?? '',
            'technician4_name' => $event['technician4_name'] ?? '',
            'region_name' => $event['region_name'] ?? ''
        ];
    }, $events);

    error_log("Envoi de la réponse JSON");
    echo json_encode([
        'success' => true,
        'data' => $formattedEvents,
        'pagination' => [
            'page' => $page,
            'limit' => $limit,
            'total' => $pdo->query("SELECT COUNT(*) FROM events")->fetchColumn()
        ]
    ], JSON_UNESCAPED_UNICODE);

} catch(Exception $e) {
    error_log("Erreur dans events.php : " . $e->getMessage());
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => "Erreur serveur",
        'details' => $e->getMessage()
    ], JSON_UNESCAPED_UNICODE);
} 