<?php

require_once __DIR__ . '/../vendor/autoload.php';

use ProgressionWebService\Credentials;
use ProgressionWebService\LoginRequest;
use ProgressionWebService\LogoutRequest;
use ProgressionWebService\ProgressionPortType;
use ProgressionWebService\SearchRecordsRequest;
use ProgressionWebService\RecordType;
use ProgressionWebService\ArrayOfProperty;
use ProgressionWebService\Property;

// Charger la configuration
$config = require_once __DIR__ . '/../progression/config.php';

try {
    // Initialiser le service
    $serverUrl = "https://{$config['company_domain']}.progressionlive.com";
    $serviceUrl = $serverUrl . '/server/ws/v2/ProgressionWebService';
    $wsdlUrl = $serviceUrl . '?wsdl';

    $service = new ProgressionPortType(array(), $wsdlUrl);
    $service->__setLocation($serviceUrl);

    // Connexion
    $credentials = new Credentials();
    $credentials->setUsername($config['username']);
    $credentials->setPassword($config['password']);
    
    $loginResponse = $service->Login(new LoginRequest($credentials));
    $credentials = $loginResponse->getCredentials();

    // Exemple de recherche d'une tâche
    $taskCode = 'INS010298';  // Remplacez par le code que vous voulez chercher
    
    $searchRequest = new SearchRecordsRequest();
    $searchRequest->setCredentials($credentials);
    $searchRequest->setRecordType(RecordType::TASK);
    $searchRequest->setQuery('code = :code');
    
    $params = new ArrayOfProperty();
    $codeParam = new Property();
    $codeParam->setName('code');
    $codeParam->setValue(new \SoapVar($taskCode, XSD_STRING, 'string', 'http://www.w3.org/2001/XMLSchema'));
    $params->setProperty(array($codeParam));
    $searchRequest->setParameters($params);

    $response = $service->SearchRecords($searchRequest);
    
    // Traiter la réponse
    if ($response && $response->getRecords()) {
        foreach ($response->getRecords()->getRecord() as $task) {
            echo "Tâche trouvée :\n";
            echo "Code : " . $task->getCode() . "\n";
            echo "Résumé : " . $task->getSummary() . "\n";
            echo "Description : " . $task->getDescription() . "\n";
            
            if ($task->getTaskItemList()) {
                echo "\nItems :\n";
                foreach ($task->getTaskItemList()->getTaskItems() as $item) {
                    echo "- " . $item->getLabel() . " : " . $item->getQuantity() . " x " . $item->getPrice() . "$ = " . $item->getTotal() . "$\n";
                }
                echo "Total : " . $task->getTaskItemList()->getTotal() . "$\n";
            }
        }
    } else {
        echo "Aucune tâche trouvée.\n";
    }

    // Déconnexion
    $service->Logout(new LogoutRequest($credentials));

} catch (Exception $e) {
    echo "Erreur : " . $e->getMessage() . "\n";
    if ($config['debug']) {
        echo "Détails : " . $e->getTraceAsString() . "\n";
    }
} 