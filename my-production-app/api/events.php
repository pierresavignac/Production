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

        // Pour les vacances, vérifier le vacation_group_id
        if (isset($data['type']) && $data['type'] === 'vacances') {
            if (!isset($data['vacation_group_id'])) {
                // Si pas de vacation_group_id fourni, en générer un nouveau
                $data['vacation_group_id'] = uniqid('vac_', true);
            }
            error_log("Création événement vacances avec vacation_group_id: " . $data['vacation_group_id']);
            
            // Utiliser les dates fournies
            $data['vacation_group_start_date'] = $data['startDate'] ?? $data['date'];
            $data['vacation_group_end_date'] = $data['endDate'] ?? $data['date'];
        }

        // Préparer la requête SQL
        $sql = "INSERT INTO events (
            type, date, first_name, last_name, 
            installation_number, installation_time, city, 
            equipment, amount, technician1_id, technician2_id, 
            technician3_id, technician4_id, employee_id, region_id,
            vacation_group_id, vacation_group_start_date, vacation_group_end_date
        ) VALUES (
            :type, :date, :first_name, :last_name, 
            :installation_number, :installation_time, :city, 
            :equipment, :amount, :technician1_id, :technician2_id, 
            :technician3_id, :technician4_id, :employee_id, :region_id,
            :vacation_group_id, :vacation_group_start_date, :vacation_group_end_date
        )";

        $stmt = $pdo->prepare($sql);
        
        // Préparer les paramètres
        $params = [
            ':type' => $data['type'],
            ':date' => $data['date'],
            ':first_name' => $data['first_name'] ?? '',
            ':last_name' => $data['last_name'] ?? '',
            ':installation_number' => $data['installation_number'] ?? '',
            ':installation_time' => $data['installation_time'] ?? '',
            ':city' => $data['city'] ?? '',
            ':equipment' => $data['equipment'] ?? '',
            ':amount' => $data['amount'] ?? '',
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

        error_log("Paramètres de l'insertion : " . json_encode($params));

        if (!$stmt->execute($params)) {
            throw new Exception("Erreur lors de l'exécution de la requête");
        }

        $newId = $pdo->lastInsertId();
        $response = [
            'success' => true,
            'message' => 'Événement ajouté avec succès',
            'id' => $newId,
            'vacation_group_id' => $data['vacation_group_id'] ?? null
        ];
        
        error_log("Réponse envoyée : " . json_encode($response));
        echo json_encode($response);

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
        // Lire les données JSON du corps de la requête
        $rawData = file_get_contents('php://input');
        $data = json_decode($rawData, true);
        
        // Récupérer l'ID de l'URL
        $id = $_GET['id'] ?? null;
        
        if (!$id) {
            throw new Exception("ID manquant");
        }
        
        error_log("DEBUG Suppression - ID: " . $id);
        error_log("DEBUG Suppression - Données reçues: " . $rawData);
        error_log("DEBUG Suppression - Mode de suppression: " . ($data['deleteMode'] ?? 'non spécifié'));

        if (isset($data['deleteMode']) && $data['deleteMode'] === 'group') {
            error_log("DEBUG Vacances - Tentative de suppression en groupe");
            
            // Récupérer d'abord le vacation_group_id
            $stmt = $pdo->prepare("SELECT vacation_group_id FROM events WHERE id = ?");
            $stmt->execute([$id]);
            $event = $stmt->fetch(PDO::FETCH_ASSOC);
            
            error_log("DEBUG Vacances - Event trouvé: " . json_encode($event));
            
            if ($event && $event['vacation_group_id']) {
                error_log("DEBUG Vacances - Tentative de suppression du groupe: " . $event['vacation_group_id']);
                
                // Compter combien d'événements sont dans le groupe
                $countStmt = $pdo->prepare("SELECT COUNT(*) FROM events WHERE vacation_group_id = ?");
                $countStmt->execute([$event['vacation_group_id']]);
                $count = $countStmt->fetchColumn();
                error_log("DEBUG Vacances - Nombre d'événements dans le groupe: " . $count);
                
                // Supprimer tous les événements du même groupe
                $stmt = $pdo->prepare("DELETE FROM events WHERE vacation_group_id = ?");
                $result = $stmt->execute([$event['vacation_group_id']]);
                error_log("DEBUG Vacances - Résultat de la suppression: " . ($result ? 'succès' : 'échec'));
            } else {
                error_log("DEBUG Vacances - Pas de vacation_group_id trouvé pour l'événement " . $id);
                // Supprimer juste l'événement individuel si pas de groupe
                $stmt = $pdo->prepare("DELETE FROM events WHERE id = ?");
                $stmt->execute([$id]);
            }
        } else {
            // Suppression individuelle
            $stmt = $pdo->prepare("DELETE FROM events WHERE id = ?");
            $stmt->execute([$id]);
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