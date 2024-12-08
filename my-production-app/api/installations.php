<?php
require_once __DIR__ . '/progression/ProgressionWebServiceV2/autoload.php';
require_once __DIR__ . '/progression/ProgressionWebServiceV2/Utils.php';
require_once __DIR__ . '/progression/TaskProxy.php';
require_once __DIR__ . '/progression/TaskMapper.php';

use ProgressionWebService\TaskProxy;
use ProgressionWebService\TaskMapper;

// Endpoint pour le fetch
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['fetch'])) {
    $installationNumber = $_POST['installation_number'] ?? '';
    
    try {
        // Initialiser la connexion
        $taskProxy = new TaskProxy(
            $config['username'],
            $config['password'],
            $config['company_domain']
        );
        
        $taskProxy->connect();
        
        // Rechercher la tâche
        $tasks = $taskProxy->findTaskByCode($installationNumber);
        
        // Convertir les données avec le mapper
        $formattedTask = TaskMapper::mapTaskResponse($tasks);
        
        if ($formattedTask) {
            // Retourner les données formatées
            echo json_encode([
                'success' => true,
                'data' => [
                    'installation_number' => $formattedTask['code'],
                    'full_name' => $formattedTask['client']['name'],
                    'phone' => $formattedTask['client']['phone'],
                    'address' => $formattedTask['client']['address']['street'],
                    'city' => $formattedTask['client']['address']['city'],
                    'summary' => $formattedTask['summary'],
                    'description' => $formattedTask['description'],
                    'amount' => $formattedTask['totals']['total'],
                    'progression_task_id' => $formattedTask['code']
                ]
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'error' => 'Installation non trouvée'
            ]);
        }
        
        $taskProxy->disconnect();
        
    } catch (Exception $e) {
        echo json_encode([
            'success' => false,
            'error' => $e->getMessage()
        ]);
    }
    exit;
} 