<?php
require_once 'config.php';

// Activer l'affichage des erreurs
ini_set('display_errors', 0);
error_reporting(E_ALL);

// Headers communs
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, DELETE, PUT, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

// Log function
function logError($message, $data = null) {
    $logMessage = date('Y-m-d H:i:s') . " - " . $message;
    if ($data) {
        if (is_array($data) || is_object($data)) {
            $logMessage .= " - Data: " . json_encode($data, JSON_UNESCAPED_UNICODE);
        } else {
            $logMessage .= " - Data: " . $data;
        }
    }
    error_log($logMessage . "\n", 3, __DIR__ . "/debug.log");
}

// Gérer les requêtes OPTIONS (CORS)
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

// GET - Récupérer les événements
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    try {
        logError("Début de la requête GET");
        
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
        ");
        
        $stmt->execute();
        $events = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        logError("Événements récupérés", count($events));
        
        echo json_encode($events, JSON_UNESCAPED_UNICODE);
        
    } catch(Exception $e) {
        logError("Erreur", $e->getMessage());
        http_response_code(500);
        echo json_encode(['error' => $e->getMessage()], JSON_UNESCAPED_UNICODE);
    }
    exit;
}

// POST - Créer un événement
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $input = file_get_contents('php://input');
        $postData = json_decode($input, true);
        
        logError("Données reçues pour création", $postData);
        
        if (empty($postData['type']) || empty($postData['date'])) {
            throw new Exception("Type et date sont requis");
        }

        $sql = "INSERT INTO events (
            type, date, first_name, last_name, installation_number,
            installation_time, city, equipment, amount,
            technician1_id, technician2_id, technician3_id, technician4_id,
            employee_id
        ) VALUES (
            :type, :date, :first_name, :last_name, :installation_number,
            :installation_time, :city, :equipment, :amount,
            :technician1_id, :technician2_id, :technician3_id, :technician4_id,
            :employee_id
        )";
        
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'type' => $postData['type'],
            'date' => $postData['date'],
            'first_name' => $postData['first_name'] ?? null,
            'last_name' => $postData['last_name'] ?? null,
            'installation_number' => $postData['installation_number'] ?? null,
            'installation_time' => $postData['installation_time'] ?? null,
            'city' => $postData['city'] ?? null,
            'equipment' => $postData['equipment'] ?? null,
            'amount' => $postData['amount'] ?? null,
            'technician1_id' => $postData['technician1_id'] ?? null,
            'technician2_id' => $postData['technician2_id'] ?? null,
            'technician3_id' => $postData['technician3_id'] ?? null,
            'technician4_id' => $postData['technician4_id'] ?? null,
            'employee_id' => $postData['employee_id'] ?? null
        ]);
        
        $newId = $pdo->lastInsertId();
        logError("Événement créé avec ID", $newId);
        
        echo json_encode(['success' => true, 'id' => $newId], JSON_UNESCAPED_UNICODE);
        
    } catch(Exception $e) {
        logError("Erreur lors de la création", $e->getMessage());
        http_response_code(500);
        echo json_encode(['error' => $e->getMessage()], JSON_UNESCAPED_UNICODE);
    }
    exit;
}

// PUT - Mettre à jour un événement
if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    try {
        $input = file_get_contents('php://input');
        $putData = json_decode($input, true);
        
        logError("Données reçues pour modification", $putData);
        
        if (empty($putData['id'])) {
            throw new Exception("ID est requis");
        }

        $sql = "UPDATE events SET 
            type = :type,
            date = :date,
            first_name = :first_name,
            last_name = :last_name,
            installation_number = :installation_number,
            installation_time = :installation_time,
            region_id = :region_id,
            city = :city,
            equipment = :equipment,
            amount = :amount,
            technician1_id = :technician1_id,
            technician2_id = :technician2_id,
            technician3_id = :technician3_id,
            technician4_id = :technician4_id,
            employee_id = :employee_id
            WHERE id = :id";
        
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'id' => $putData['id'],
            'type' => $putData['type'],
            'date' => $putData['date'],
            'first_name' => $putData['first_name'] ?? null,
            'last_name' => $putData['last_name'] ?? null,
            'installation_number' => $putData['installation_number'] ?? null,
            'installation_time' => $putData['installation_time'] ?? null,
            'region_id' => $putData['region_id'] ?? null,
            'city' => $putData['city'] ?? null,
            'equipment' => $putData['equipment'] ?? null,
            'amount' => $putData['amount'] ?? null,
            'technician1_id' => $putData['technician1_id'] ?? null,
            'technician2_id' => $putData['technician2_id'] ?? null,
            'technician3_id' => $putData['technician3_id'] ?? null,
            'technician4_id' => $putData['technician4_id'] ?? null,
            'employee_id' => $putData['employee_id'] ?? null
        ]);
        
        logError("Événement mis à jour", $putData['id']);
        echo json_encode(['success' => true], JSON_UNESCAPED_UNICODE);
        
    } catch(Exception $e) {
        logError("Erreur lors de la modification", $e->getMessage());
        http_response_code(500);
        echo json_encode(['error' => $e->getMessage()], JSON_UNESCAPED_UNICODE);
    }
    exit;
}

// DELETE - Supprimer un événement
if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    try {
        $url = parse_url($_SERVER['REQUEST_URI']);
        parse_str($url['query'] ?? '', $params);
        $eventId = $params['id'] ?? null;

        if (!$eventId) {
            throw new Exception("ID de l'événement non spécifié");
        }

        logError("Tentative de suppression de l'événement", $eventId);

        $stmt = $pdo->prepare("DELETE FROM events WHERE id = ?");
        $stmt->execute([$eventId]);
        
        logError("Événement supprimé avec succès", $eventId);
        echo json_encode(['success' => true]);

    } catch(Exception $e) {
        logError("Erreur lors de la suppression", $e->getMessage());
        http_response_code(500);
        echo json_encode(['error' => $e->getMessage()], JSON_UNESCAPED_UNICODE);
    }
    exit;
}
?>