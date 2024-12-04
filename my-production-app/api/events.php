<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once 'config.php';
setCorsHeaders();

// Log pour le débogage
error_log("Début de la requête events.php - Méthode: " . $_SERVER['REQUEST_METHOD']);

// Activer l'affichage des erreurs dans le log
ini_set('log_errors', 1);
ini_set('error_log', __DIR__ . '/debug.log');

// Gérer les requêtes OPTIONS
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

// Gérer les différentes méthodes HTTP
switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        handleGet($pdo);
        break;
    case 'POST':
        handlePost($pdo);
        break;
    case 'PUT':
        handlePut($pdo);
        break;
    case 'DELETE':
        handleDelete($pdo);
        break;
    default:
        http_response_code(405);
        echo json_encode(['error' => 'Méthode non autorisée']);
        break;
}

// Fonction pour gérer les requêtes GET
function handleGet($pdo) {
    try {
        $page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
        $limit = isset($_GET['limit']) ? min(50, max(1, intval($_GET['limit']))) : 20;
        $offset = ($page - 1) * $limit;
        
        $stmt = $pdo->prepare("
            SELECT 
                e.*,
                CONCAT(emp.first_name, ' ', emp.last_name) as employee_name,
                t1.id as technician1_id,
                CONCAT(t1.first_name, ' ', t1.last_name) as technician1_name,
                t2.id as technician2_id,
                CONCAT(t2.first_name, ' ', t2.last_name) as technician2_name,
                t3.id as technician3_id,
                CONCAT(t3.first_name, ' ', t3.last_name) as technician3_name,
                t4.id as technician4_id,
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
                'technician1_id' => $event['technician1_id'] ?? null,
                'technician2_id' => $event['technician2_id'] ?? null,
                'technician3_id' => $event['technician3_id'] ?? null,
                'technician4_id' => $event['technician4_id'] ?? null,
                'technician1_name' => $event['technician1_name'] ?? '',
                'technician2_name' => $event['technician2_name'] ?? '',
                'technician3_name' => $event['technician3_name'] ?? '',
                'technician4_name' => $event['technician4_name'] ?? '',
                'region_name' => $event['region_name'] ?? '',
                'region_id' => $event['region_id'] ?? null,
                'employee_id' => $event['employee_id'] ?? null
            ];
        }, $events);

        error_log("Envoi de la réponse JSON avec " . count($formattedEvents) . " événements");
        
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
        error_log("Erreur dans handleGet : " . $e->getMessage());
        http_response_code(500);
        echo json_encode([
            'success' => false,
            'message' => "Erreur serveur",
            'details' => $e->getMessage()
        ]);
    }
}

// Fonction pour gérer les requêtes POST
function handlePost($pdo) {
    try {
        $data = json_decode(file_get_contents('php://input'), true);
        error_log("Données POST reçues : " . json_encode($data));

        $sql = "INSERT INTO events (
            type, date, first_name, last_name, installation_number, 
            installation_time, city, equipment, amount, 
            technician1_id, technician2_id, technician3_id, technician4_id, 
            employee_id, region_id
        ) VALUES (
            :type, :date, :first_name, :last_name, :installation_number,
            :installation_time, :city, :equipment, :amount,
            :technician1_id, :technician2_id, :technician3_id, :technician4_id,
            :employee_id, :region_id
        )";

        $stmt = $pdo->prepare($sql);
        
        $params = [
            ':type' => $data['type'],
            ':date' => $data['date'],
            ':first_name' => $data['first_name'] ?? null,
            ':last_name' => $data['last_name'] ?? null,
            ':installation_number' => $data['installation_number'] ?? null,
            ':installation_time' => $data['installation_time'] ?? null,
            ':city' => $data['city'] ?? null,
            ':equipment' => $data['equipment'] ?? null,
            ':amount' => $data['amount'] ?? null,
            ':technician1_id' => $data['technician1_id'] ?? null,
            ':technician2_id' => $data['technician2_id'] ?? null,
            ':technician3_id' => $data['technician3_id'] ?? null,
            ':technician4_id' => $data['technician4_id'] ?? null,
            ':employee_id' => $data['employee_id'] ?? null,
            ':region_id' => $data['region_id'] ?? null
        ];

        error_log("Paramètres de la requête : " . json_encode($params));

        if (!$stmt->execute($params)) {
            throw new Exception("Erreur lors de l'exécution de la requête");
        }

        $newId = $pdo->lastInsertId();
        echo json_encode([
            'success' => true,
            'message' => 'Événement ajouté avec succès',
            'id' => $newId
        ]);

    } catch(Exception $e) {
        error_log("Erreur dans handlePost : " . $e->getMessage());
        http_response_code(500);
        echo json_encode([
            'success' => false,
            'message' => $e->getMessage()
        ]);
    }
}

// Fonction pour gérer les requêtes PUT
function handlePut($pdo) {
    try {
        $data = json_decode(file_get_contents('php://input'), true);
        error_log("Données PUT reçues : " . json_encode($data));

        if (!isset($data['id'])) {
            throw new Exception("ID manquant pour la modification");
        }

        $sql = "UPDATE events SET 
            type = :type,
            date = :date,
            first_name = :first_name,
            last_name = :last_name,
            installation_number = :installation_number,
            installation_time = :installation_time,
            city = :city,
            equipment = :equipment,
            amount = :amount,
            technician1_id = :technician1_id,
            technician2_id = :technician2_id,
            technician3_id = :technician3_id,
            technician4_id = :technician4_id,
            employee_id = :employee_id,
            region_id = :region_id
            WHERE id = :id";

        $stmt = $pdo->prepare($sql);
        
        $params = [
            ':id' => $data['id'],
            ':type' => $data['type'],
            ':date' => $data['date'],
            ':first_name' => $data['first_name'] ?? null,
            ':last_name' => $data['last_name'] ?? null,
            ':installation_number' => $data['installation_number'] ?? null,
            ':installation_time' => $data['installation_time'] ?? null,
            ':city' => $data['city'] ?? null,
            ':equipment' => $data['equipment'] ?? null,
            ':amount' => $data['amount'] ?? null,
            ':technician1_id' => $data['technician1_id'] ?? null,
            ':technician2_id' => $data['technician2_id'] ?? null,
            ':technician3_id' => $data['technician3_id'] ?? null,
            ':technician4_id' => $data['technician4_id'] ?? null,
            ':employee_id' => $data['employee_id'] ?? null,
            ':region_id' => $data['region_id'] ?? null
        ];

        error_log("Paramètres de la requête UPDATE : " . json_encode($params));

        if (!$stmt->execute($params)) {
            throw new Exception("Erreur lors de la modification");
        }

        echo json_encode([
            'success' => true,
            'message' => 'Événement modifié avec succès'
        ]);

    } catch(Exception $e) {
        error_log("Erreur dans handlePut : " . $e->getMessage());
        http_response_code(500);
        echo json_encode([
            'success' => false,
            'message' => $e->getMessage()
        ]);
    }
}

// Fonction pour gérer les requêtes DELETE
function handleDelete($pdo) {
    try {
        $id = isset($_GET['id']) ? $_GET['id'] : null;
        if (!$id) {
            throw new Exception('ID manquant');
        }

        $stmt = $pdo->prepare("DELETE FROM events WHERE id = ?");
        if (!$stmt->execute([$id])) {
            throw new Exception('Erreur lors de la suppression');
        }

        echo json_encode([
            'success' => true,
            'message' => 'Événement supprimé avec succès'
        ]);

    } catch(Exception $e) {
        error_log("Erreur dans handleDelete : " . $e->getMessage());
        http_response_code(500);
        echo json_encode([
            'success' => false,
            'message' => $e->getMessage()
        ]);
    }
} 