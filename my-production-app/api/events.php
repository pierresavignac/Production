<?php
ini_set('display_errors', 0);
error_reporting(E_ALL);

require_once 'config.php';
setCorsHeaders();

// Ajouter la colonne vacation_group_id si elle n'existe pas
try {
    $pdo->exec("ALTER TABLE events ADD COLUMN IF NOT EXISTS vacation_group_id VARCHAR(36) DEFAULT NULL");
    $pdo->exec("ALTER TABLE events ADD COLUMN IF NOT EXISTS vacation_group_start_date DATE DEFAULT NULL");
    $pdo->exec("ALTER TABLE events ADD COLUMN IF NOT EXISTS vacation_group_end_date DATE DEFAULT NULL");
} catch(Exception $e) {
    error_log("Erreur lors de l'ajout des colonnes de groupe de vacances : " . $e->getMessage());
}

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
        ");
        
        $stmt->execute();
        $events = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
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
                'employee_id' => $event['employee_id'] ?? null,
                'vacation_group_id' => $event['vacation_group_id'] ?? null,
                'vacation_group_start_date' => $event['vacation_group_start_date'] ?? null,
                'vacation_group_end_date' => $event['vacation_group_end_date'] ?? null
            ];
        }, $events);
        
        echo json_encode([
            'success' => true,
            'data' => $formattedEvents
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
        if (!$data) {
            throw new Exception("Données JSON invalides");
        }
        error_log("Données POST reçues : " . json_encode($data));

        if (isset($data['type']) && $data['type'] === 'vacances') {
            $groupId = uniqid('vac_', true);
            $data['vacation_group_id'] = $groupId;
            
            // Utiliser la date de l'événement si startDate/endDate ne sont pas fournis
            $data['vacation_group_start_date'] = isset($data['startDate']) ? $data['startDate'] : $data['date'];
            $data['vacation_group_end_date'] = isset($data['endDate']) ? $data['endDate'] : $data['date'];
        }

        $sql = "INSERT INTO events (
            type, date, first_name, last_name, installation_number, 
            installation_time, city, equipment, amount, 
            technician1_id, technician2_id, technician3_id, technician4_id, 
            employee_id, region_id, vacation_group_id,
            vacation_group_start_date, vacation_group_end_date
        ) VALUES (
            :type, :date, :first_name, :last_name, :installation_number,
            :installation_time, :city, :equipment, :amount,
            :technician1_id, :technician2_id, :technician3_id, :technician4_id,
            :employee_id, :region_id, :vacation_group_id,
            :vacation_group_start_date, :vacation_group_end_date
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
            ':region_id' => $data['region_id'] ?? null,
            ':vacation_group_id' => $data['vacation_group_id'] ?? null,
            ':vacation_group_start_date' => $data['vacation_group_start_date'] ?? null,
            ':vacation_group_end_date' => $data['vacation_group_end_date'] ?? null
        ];

        if (!$stmt->execute($params)) {
            throw new Exception("Erreur lors de l'exécution de la requête");
        }

        $newId = $pdo->lastInsertId();
        echo json_encode([
            'success' => true,
            'message' => 'Événement ajouté avec succès',
            'id' => $newId,
            'vacation_group_id' => $data['vacation_group_id'] ?? null
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

        if ($data['type'] === 'vacances' && isset($data['updateMode'])) {
            if ($data['updateMode'] === 'group') {
                // Mise à jour groupée
                $sql = "UPDATE events SET 
                    vacation_group_start_date = :start_date,
                    vacation_group_end_date = :end_date
                    WHERE vacation_group_id = :group_id";
                
                $stmt = $pdo->prepare($sql);
                $stmt->execute([
                    ':start_date' => $data['startDate'],
                    ':end_date' => $data['endDate'],
                    ':group_id' => $data['vacation_group_id']
                ]);
            } else {
                // Mise à jour individuelle
                $sql = "UPDATE events SET 
                    date = :date,
                    vacation_group_id = NULL,
                    vacation_group_start_date = NULL,
                    vacation_group_end_date = NULL
                    WHERE id = :id";
                
                $stmt = $pdo->prepare($sql);
                $stmt->execute([
                    ':date' => $data['date'],
                    ':id' => $data['id']
                ]);
            }
        } else {
            // Mise à jour normale pour les autres types d'événements
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
            $stmt->execute($params);
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
        $data = json_decode(file_get_contents('php://input'), true);
        $id = isset($_GET['id']) ? $_GET['id'] : null;
        
        if (!$id) {
            throw new Exception('ID manquant');
        }

        if (isset($data['deleteMode']) && $data['deleteMode'] === 'group') {
            // Suppression groupée
            $stmt = $pdo->prepare("DELETE FROM events WHERE vacation_group_id = (SELECT vacation_group_id FROM events WHERE id = ?)");
        } else {
            // Suppression individuelle
            $stmt = $pdo->prepare("DELETE FROM events WHERE id = ?");
        }

        if (!$stmt->execute([$id])) {
            throw new Exception('Erreur lors de la suppression');
        }

        echo json_encode([
            'success' => true,
            'message' => 'Événement(s) supprimé(s) avec succès'
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