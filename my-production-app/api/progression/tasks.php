<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization');
header('Access-Control-Allow-Credentials: true');
header('Content-Type: application/json');

// Gérer les requêtes OPTIONS (CORS)
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

try {
    error_log("Démarrage du script tasks.php");
    error_log("Méthode HTTP: " . $_SERVER['REQUEST_METHOD']);
    error_log("Query string: " . $_SERVER['QUERY_STRING']);
    error_log("Headers reçus: " . json_encode(getallheaders()));
    
    // Chargement de la configuration
    $config = require_once __DIR__ . '/config.php';
    error_log("Configuration chargée: " . json_encode($config, JSON_PRETTY_PRINT));
    
    if (!isset($_GET['code'])) {
        throw new Exception('Le paramètre code est requis');
    }
    
    $taskCode = $_GET['code'];
    error_log("Recherche de la tâche: " . $taskCode);
    
    // Initialisation du service SOAP Progression
    require_once __DIR__ . '/ProgressionWebServiceV2/bootstrap.php';
    require_once __DIR__ . '/ProgressionWebServiceV2/Utils.php';
    
    use ProgressionWebService\Credentials;
    use ProgressionWebService\LoginRequest;
    use ProgressionWebService\LogoutRequest;
    use ProgressionWebService\ProgressionPortType;
    use ProgressionWebService\SearchRecordsRequest;
    use ProgressionWebService\RecordType;
    use ProgressionWebService\ArrayOfProperty;
    use ProgressionWebService\Property;
    use ProgressionWebService\Utils;

    // Configuration du service SOAP
    $serverUrl = "https://{$config['company_domain']}.progressionlive.com";
    $serviceUrl = $serverUrl . '/server/ws/v2/ProgressionWebService';
    $wsdlUrl = $serviceUrl . '?wsdl';

    error_log("Initialisation du service SOAP...");
    $service = new ProgressionPortType(['trace' => true], $wsdlUrl);
    $service->__setLocation($serviceUrl);

    // Authentification
    $credentials = new Credentials();
    $credentials->setUsername($config['username']);
    $credentials->setPassword($config['password']);
    
    error_log("Tentative de connexion...");
    $loginResponse = $service->Login(new LoginRequest($credentials));
    $credentials = $loginResponse->getCredentials();

    // Recherche de la tâche
    $searchRequest = new SearchRecordsRequest();
    $searchRequest->setCredentials($credentials);
    $searchRequest->setRecordType(RecordType::TASK);
    $searchRequest->setQuery('code = :code');
    
    $params = new ArrayOfProperty();
    $codeParam = new Property();
    $codeParam->setName('code');
    $codeParam->setValue(Utils::createStringParam($taskCode));
    $params->setProperty(array($codeParam));
    $searchRequest->setParameters($params);

    error_log("Requête SOAP préparée: " . json_encode([
        'type' => 'SearchRecords',
        'recordType' => RecordType::TASK,
        'query' => 'code = :code',
        'parameters' => [
            'code' => $taskCode
        ]
    ]));
    
    error_log("Exécution de la recherche...");
    $response = $service->SearchRecords($searchRequest);
    error_log("Réponse SOAP reçue: " . json_encode($response));
    
    // Traitement de la réponse
    $result = null;
    if ($response && $response->getRecords() && $response->getRecords()->getRecord()) {
        $tasks = $response->getRecords()->getRecord();
        error_log("Nombre de tâches trouvées: " . count($tasks));
        if (count($tasks) > 0) {
            error_log("Formatage de la première tâche...");
            $result = Utils::formatTaskResponse($tasks[0]);
            error_log("Résultat formaté: " . json_encode($result));
        }
    }

    // Déconnexion
    $service->Logout(new LogoutRequest($credentials));

    if ($result === null) {
        http_response_code(404);
        echo json_encode([
            'success' => false,
            'error' => 'Tâche non trouvée'
        ]);
    } else {
        echo json_encode([
            'success' => true,
            'data' => $result
        ]);
    }

} catch (\SoapFault $e) {
    error_log("Erreur SOAP: " . $e->getMessage());
    error_log("Code d'erreur SOAP: " . $e->getCode());
    error_log("Dernier message SOAP envoyé: " . (isset($service) ? $service->__getLastRequest() : 'N/A'));
    error_log("Dernière réponse SOAP reçue: " . (isset($service) ? $service->__getLastResponse() : 'N/A'));
    error_log("Trace complète: " . $e->getTraceAsString());
    
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'error' => 'Erreur de communication avec le service Progression',
        'details' => $e->getMessage(),
        'code' => $e->getCode()
    ]);
} catch (Exception $e) {
    error_log("Erreur dans tasks.php: " . $e->getMessage());
    error_log("Code d'erreur: " . $e->getCode());
    error_log("Stack trace: " . $e->getTraceAsString());
    
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'error' => $e->getMessage(),
        'code' => $e->getCode()
    ]);
} 