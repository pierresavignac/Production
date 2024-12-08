<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

// Activation de l'affichage des erreurs pour le débogage
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Configuration du fichier de log
$logFile = __DIR__ . '/worksheet_debug.log';
function writeLog($message) {
    global $logFile;
    $timestamp = date('Y-m-d H:i:s');
    file_put_contents($logFile, "[$timestamp] $message\n", FILE_APPEND);
}

try {
    writeLog("Début du traitement de la requête");
    
    // Gestion de la requête OPTIONS pour CORS
    if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
        http_response_code(200);
        exit();
    }

    // Vérification de la méthode HTTP
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception('Méthode non autorisée');
    }

    // Lecture des données JSON
    $input = file_get_contents('php://input');
    writeLog("Données reçues: " . $input);

    if (empty($input)) {
        throw new Exception('Aucune donnée reçue');
    }

    $data = json_decode($input, true);
    if (json_last_error() !== JSON_ERROR_NONE) {
        throw new Exception('Erreur de décodage JSON: ' . json_last_error_msg());
    }

    // Validation des données requises
    $requiredFields = ['installation_id', 'name'];
    foreach ($requiredFields as $field) {
        if (!isset($data[$field]) || empty($data[$field])) {
            throw new Exception("Le champ '$field' est requis");
        }
    }

    // Connexion à la base de données
    require_once 'db_connect.php';
    writeLog("Connexion à la base de données établie");

    // Préparation des données pour l'insertion
    $particularities = isset($data['particularities']) ? json_encode($data['particularities']) : '{}';
    
    // Requête SQL
    $sql = "INSERT INTO worksheets (
        installation_id, name, address, phone, has_visit, visitor_name,
        house_type, aluminum1, length_count1, aluminum2, length_count2,
        support_type, electric_panel, has_panel_space, basement,
        installation_type, sub_installation_type, particularities
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    writeLog("Requête SQL préparée: $sql");

    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        throw new Exception("Erreur de préparation de la requête: " . $conn->error);
    }

    $stmt->bind_param("isssisssisissiisss",
        $data['installation_id'],
        $data['name'],
        $data['address'],
        $data['phone'],
        $data['has_visit'],
        $data['visitor_name'],
        $data['house_type'],
        $data['aluminum1'],
        $data['length_count1'],
        $data['aluminum2'],
        $data['length_count2'],
        $data['support_type'],
        $data['electric_panel'],
        $data['has_panel_space'],
        $data['basement'],
        $data['installation_type'],
        $data['sub_installation_type'],
        $particularities
    );

    if (!$stmt->execute()) {
        throw new Exception("Erreur d'exécution de la requête: " . $stmt->error);
    }

    writeLog("Insertion réussie. ID généré: " . $stmt->insert_id);

    // Réponse de succès
    echo json_encode([
        'success' => true,
        'message' => 'Worksheet saved successfully',
        'id' => $stmt->insert_id
    ]);

} catch (Exception $e) {
    writeLog("Erreur: " . $e->getMessage());
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'error' => $e->getMessage()
    ]);
} 