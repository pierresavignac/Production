<?php

date_default_timezone_set('America/Montreal');

require_once __DIR__ . '/autoload.php';
require_once __DIR__ . '/Utils.php';

use ProgressionWebService\Credentials;
use ProgressionWebService\LoginRequest;
use ProgressionWebService\LogoutRequest;
use ProgressionWebService\ProgressionPortType;
use ProgressionWebService\SearchRecordsRequest;
use ProgressionWebService\RecordType;
use ProgressionWebService\ArrayOfProperty;
use ProgressionWebService\Property;

class TaskSearcher {
    private $service;
    private $credentials;
    private $companyDomain;
    private $debug = false;  // Désactivé par défaut

    public function __construct($username, $password, $companyDomain) {
        $this->companyDomain = $companyDomain;
        $serverUrl = "https://{$companyDomain}.progressionlive.com";
        $serviceUrl = $serverUrl . '/server/ws/v2/ProgressionWebService';
        $wsdlUrl = $serviceUrl . '?wsdl';

        // Configuration du client SOAP
        $opts = array(
            'connection_timeout' => 30,
            'features' => SOAP_SINGLE_ELEMENT_ARRAYS,
            'trace' => true
        );

        // Initialisation du service
        $this->service = new ProgressionPortType($opts, $wsdlUrl);
        $this->service->__setLocation($serviceUrl);

        // Préparation des credentials
        $this->credentials = new Credentials();
        $this->credentials->setUsername($username);
        $this->credentials->setPassword($password);
    }

    public function connect() {
        try {
            $loginResponse = $this->service->Login(new LoginRequest($this->credentials));
            $this->credentials = $loginResponse->getCredentials();
            echo "Connexion réussie à {$this->companyDomain}.progressionlive.com\n";
            return $this;
        } catch (Exception $e) {
            throw new Exception("Erreur de connexion : " . $e->getMessage());
        }
    }

    public function searchTaskByCode($code) {
        $searchRequest = new SearchRecordsRequest();
        $searchRequest->setCredentials($this->credentials);
        $searchRequest->setRecordType(RecordType::TASK);
        
        // Requête exacte pour le code
        $searchRequest->setQuery('code = :code');
        
        // Préparation des paramètres
        $params = new ArrayOfProperty();
        $codeParam = new Property();
        $codeParam->setName('code');
        $codeParam->setValue(new \SoapVar($code, XSD_STRING, 'string', 'http://www.w3.org/2001/XMLSchema'));
        $params->setProperty(array($codeParam));
        $searchRequest->setParameters($params);

        try {
            $response = $this->service->SearchRecords($searchRequest);
            if ($response && $response->getRecords()) {
                return $response->getRecords()->getRecord();
            }
            return null;
        } catch (Exception $e) {
            echo "Erreur lors de la recherche : " . $e->getMessage() . "\n";
            if ($this->debug && $this->service->__getLastResponse()) {
                echo "Détails de l'erreur : " . $this->service->__getLastResponse() . "\n";
            }
            return null;
        }
    }

    public function disconnect() {
        try {
            $this->service->Logout(new LogoutRequest($this->credentials));
            echo "Déconnexion réussie\n";
        } catch (Exception $e) {
            echo "Erreur lors de la déconnexion : " . $e->getMessage() . "\n";
        }
    }

    public function setDebug($debug) {
        $this->debug = $debug;
        return $this;
    }
}

// Code d'exemple qui ne s'exécute que si le script est appelé directement
if (basename(__FILE__) === basename($_SERVER['SCRIPT_FILENAME'])) {
    if ($argc < 4) {
        die("Usage: php searchTask.php COMPANY_DOMAIN USERNAME PASSWORD [CODE_TACHE]\nExemple: php searchTask.php garychartrand pierre@garychartrand.com password INS010298\n");
    }

    $companyDomain = $argv[1];
    $username = $argv[2];
    $password = $argv[3];
    $code = isset($argv[4]) ? $argv[4] : null;

    $searcher = new TaskSearcher($username, $password, $companyDomain);
    $searcher->connect();

    if ($code) {
        $tasks = $searcher->searchTaskByCode($code);
        if ($tasks) {
            foreach ($tasks as $task) {
                echo "Tâche trouvée : " . $task->getCode() . " - " . $task->getSummary() . "\n";
            }
        } else {
            echo "Aucune tâche trouvée avec le code $code\n";
        }
    }

    $searcher->disconnect();
} 