<?php

require_once __DIR__ . '/ProgressionWebServiceV2/autoload.php';
require_once __DIR__ . '/ProgressionWebServiceV2/Utils.php';
require_once __DIR__ . '/TaskProxy.php';
require_once __DIR__ . '/TaskMapper.php';

use ProgressionWebService\TaskProxy;
use ProgressionWebService\TaskMapper;

// Activer le rapport d'erreurs pour le débogage
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Définir le fuseau horaire
date_default_timezone_set('America/Montreal');

// Charger la configuration
$config = require_once __DIR__ . '/config.php';

try {
    $taskCode = 'INS010298';
    
    echo "Connexion au service...\n";
    $taskProxy = new TaskProxy(
        $config['username'],
        $config['password'],
        $config['company_domain']
    );
    
    // Activer le mode debug
    $taskProxy->setDebug(true);
    
    echo "Tentative de connexion...\n";
    $taskProxy->connect();

    echo "Recherche de la tâche {$taskCode}...\n";
    $tasks = $taskProxy->findTaskByCode($taskCode);
    
    // Afficher les résultats
    $formattedTask = TaskMapper::mapTaskResponse($tasks);

    // Ajout de cette ligne pour voir les données converties
    echo "\nDonnées converties :\n";
    echo str_repeat('=', 40) . "\n";
    print_r($formattedTask);
    echo str_repeat('=', 40) . "\n\n";

    if ($formattedTask) {
        echo "\nDétails de la tâche :\n";
        echo str_repeat('-', 40) . "\n";
        echo "Code : " . $formattedTask['code'] . "\n";
        echo "Client : " . $formattedTask['client']['name'] . "\n";
        echo "Résumé : " . $formattedTask['summary'] . "\n";
        echo "Description : " . $formattedTask['description'] . "\n";
        echo "Date : " . date('d/m/Y H:i', strtotime($formattedTask['date'])) . "\n";
        echo "Adresse : " . $formattedTask['client']['address']['street'] . ", " . 
             $formattedTask['client']['address']['city'] . " " . $formattedTask['client']['address']['postal_code'] . "\n";
        echo "Téléphone : " . $formattedTask['client']['phone'] . "\n";
        echo "Email : " . $formattedTask['client']['email'] . "\n";
        
        if (isset($formattedTask['items']) && is_array($formattedTask['items'])) {
            echo "\nItems :\n";
            echo str_repeat('-', 40) . "\n";
            foreach ($formattedTask['items'] as $item) {
                echo "- " . str_pad($item['label'], 30) . " : " . 
                     number_format($item['quantity'], 0) . " x " . 
                     number_format($item['price'], 2) . "$ = " . 
                     number_format($item['total'], 2) . "$\n";
            }
            echo str_repeat('-', 40) . "\n";
            echo "Sous-total : " . str_pad(number_format($formattedTask['totals']['subtotal'], 2) . "$", 30, ' ', STR_PAD_LEFT) . "\n";
            
            if (isset($formattedTask['totals']['taxes']) && is_array($formattedTask['totals']['taxes'])) {
                foreach ($formattedTask['totals']['taxes'] as $taxLabel => $taxAmount) {
                    echo $taxLabel . " : " . 
                         str_pad(number_format($taxAmount, 2) . "$", 30, ' ', STR_PAD_LEFT) . "\n";
                }
            }
            echo str_repeat('-', 40) . "\n";
            echo "Total : " . str_pad(number_format($formattedTask['totals']['total'], 2) . "$", 31, ' ', STR_PAD_LEFT) . "\n";
        }
        echo str_repeat('=', 40) . "\n";
    } else {
        echo "Aucune tâche trouvée avec le code {$taskCode}\n";
    }

    // Déconnexion
    echo "\nDéconnexion...\n";
    $taskProxy->disconnect();
    echo "Test terminé avec succès!\n";

} catch (Exception $e) {
    echo "ERREUR : " . $e->getMessage() . "\n";
    if ($config['debug']) {
        echo "Fichier : " . $e->getFile() . "\n";
        echo "Ligne : " . $e->getLine() . "\n";
        echo "Trace :\n" . $e->getTraceAsString() . "\n";
    }
} 