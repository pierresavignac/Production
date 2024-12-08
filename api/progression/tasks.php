<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=UTF-8');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization');

// Activer l'affichage des erreurs pour le débogage
ini_set('display_errors', 1);
error_reporting(E_ALL);

try {
    // Validation des paramètres
    if (!isset($_GET['code']) || empty($_GET['code'])) {
        throw new Exception('Code d\'installation manquant');
    }

    $code = trim($_GET['code']);
    if (!preg_match('/^INS0\d{1,5}$/', $code)) {
        throw new Exception('Format de code invalide');
    }

    // Log pour debug
    error_log("Recherche du code: " . $code);

    // Connexion à la base de données
    require_once '../config/database.php';
    $db = new PDO("mysql:host={$db_host};dbname={$db_name}", $db_user, $db_pass);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Requête pour récupérer les données
    $query = $db->prepare("
        SELECT 
            t.id as task_id,
            t.title,
            t.description,
            t.price_with_taxes,
            c.name as customer_name,
            c.phone_number,
            a.street,
            a.city
        FROM tasks t
        LEFT JOIN customers c ON t.customer_id = c.id
        LEFT JOIN addresses a ON c.address_id = a.id
        WHERE t.installation_code = :code
    ");

    $query->execute(['code' => $code]);
    $result = $query->fetch(PDO::FETCH_ASSOC);

    if (!$result) {
        throw new Exception('Aucune donnée trouvée pour ce code d\'installation');
    }

    // Formater les données pour le front-end
    $data = [
        'customer' => [
            'name' => $result['customer_name'],
            'phoneNumber' => $result['phone_number'],
            'address' => [
                'street' => $result['street'],
                'city' => $result['city']
            ]
        ],
        'task' => [
            'id' => $result['task_id'],
            'title' => $result['title'],
            'description' => $result['description'],
            'priceWithTaxes' => $result['price_with_taxes']
        ]
    ];

    // Retourner les données en JSON
    echo json_encode([
        'success' => true,
        'data' => $data
    ]);

} catch (PDOException $e) {
    error_log("Erreur PDO: " . $e->getMessage());
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'Erreur de base de données: ' . $e->getMessage()
    ]);
} catch (Exception $e) {
    error_log("Erreur générale: " . $e->getMessage());
    http_response_code(400);
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]);
}
?> 