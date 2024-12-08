<?php

namespace ProgressionWebService;

use ProgressionWebService\Credentials;
use ProgressionWebService\LoginRequest;
use ProgressionWebService\LogoutRequest;
use ProgressionWebService\SearchRecordsRequest;
use ProgressionWebService\RecordType;
use ProgressionWebService\ArrayOfProperty;
use ProgressionWebService\Property;

class TaskProxy {
    private $soapClient;
    private $credentials;
    private $companyDomain;
    private $debug = false;

    public function __construct($username, $password, $companyDomain) {
        $this->companyDomain = $companyDomain;
        $serverUrl = "https://{$companyDomain}.progressionlive.com";
        $serviceUrl = $serverUrl . '/server/ws/v2/ProgressionWebService';
        $wsdlUrl = $serviceUrl . '?wsdl';

        // Configuration du client SOAP
        $opts = array(
            'connection_timeout' => 30,
            'features' => SOAP_SINGLE_ELEMENT_ARRAYS,
            'trace' => true,
            'exceptions' => true,
            'cache_wsdl' => WSDL_CACHE_NONE
        );

        // Initialisation du client SOAP
        $this->soapClient = new \SoapClient($wsdlUrl, $opts);
        $this->soapClient->__setLocation($serviceUrl);

        // Préparation des credentials
        $this->credentials = new Credentials();
        $this->credentials->setUsername($username);
        $this->credentials->setPassword($password);
    }

    public function connect() {
        try {
            $loginRequest = new LoginRequest($this->credentials);
            $loginResponse = $this->soapClient->Login($loginRequest);
            
            if ($this->debug) {
                echo "\nDébug - Réponse du serveur :\n";
                print_r($loginResponse);
            }
            
            // Vérification et extraction des credentials
            if (!isset($loginResponse->credentials)) {
                throw new \Exception("La réponse ne contient pas de credentials");
            }
            
            // Copie des credentials de la réponse
            $this->credentials = $loginResponse->credentials;
            
            echo "Connexion réussie à {$this->companyDomain}.progressionlive.com\n";
            return $this;
        } catch (\Exception $e) {
            if ($this->debug) {
                echo "\nDébug - Dernière requête envoyée :\n" . $this->soapClient->__getLastRequest();
                echo "\nDébug - Dernière réponse reçue :\n" . $this->soapClient->__getLastResponse();
            }
            throw new \Exception("Erreur de connexion : " . $e->getMessage());
        }
    }

    public function findTaskByCode($taskCode) {
        try {
            // Utilisation des classes spécifiques de l'API
            $searchRequest = new SearchRecordsRequest();
            $searchRequest->setCredentials($this->credentials);
            $searchRequest->setRecordType(RecordType::TASK);
            $searchRequest->setQuery('code = :code');
            
            // Création du paramètre
            $params = new ArrayOfProperty();
            $codeParam = new Property();
            $codeParam->setName('code');
            $codeParam->setValue(new \SoapVar($taskCode, XSD_STRING, 'string', 'http://www.w3.org/2001/XMLSchema'));
            $params->setProperty(array($codeParam));
            $searchRequest->setParameters($params);
            
            if ($this->debug) {
                echo "\nDébug - Requête de recherche :\n";
                print_r($searchRequest);
            }
            
            $response = $this->soapClient->SearchRecords($searchRequest);
            
            if ($this->debug) {
                echo "\nDébug - Réponse de recherche :\n";
                print_r($response);
            }
            
            if (isset($response->records) && isset($response->records->record)) {
                return $response->records->record;
            }
            
            return null;
        } catch (\Exception $e) {
            if ($this->debug) {
                echo "\nDébug - Dernière requête envoyée :\n" . $this->soapClient->__getLastRequest();
                echo "\nDébug - Dernière réponse reçue :\n" . $this->soapClient->__getLastResponse();
            }
            throw new \Exception($e->getMessage());
        }
    }

    private function convertTaskToArray($task) {
        $data = [
            'code' => isset($task->code) ? $task->code : null,
            'summary' => isset($task->summary) ? $task->summary : null,
            'description' => isset($task->description) ? $task->description : null,
            'date' => isset($task->rv) ? $task->rv : null,
            'client' => null,
            'resource' => null,
            'items' => [],
            'total' => 0
        ];

        if (isset($task->clientRef) && isset($task->clientRef->label)) {
            $data['client'] = $task->clientRef->label;
        }

        if (isset($task->humanResourceRef) && isset($task->humanResourceRef->label)) {
            $data['resource'] = $task->humanResourceRef->label;
        }

        if (isset($task->taskItemList) && isset($task->taskItemList->taskItems)) {
            $items = $task->taskItemList->taskItems;
            if (!is_array($items)) {
                $items = array($items);
            }
            
            foreach ($items as $item) {
                if (isset($item->label)) {
                    $data['items'][] = [
                        'label' => $item->label,
                        'quantity' => isset($item->quantity) ? $item->quantity : 0,
                        'price' => isset($item->price) ? $item->price : 0,
                        'total' => isset($item->total) ? $item->total : 0
                    ];
                }
            }
            
            if (isset($task->taskItemList->total)) {
                $data['total'] = $task->taskItemList->total;
            }
        }

        return $data;
    }

    public function disconnect() {
        try {
            $logoutRequest = new \stdClass();
            $logoutRequest->credentials = $this->credentials;
            
            $this->soapClient->Logout($logoutRequest);
            echo "Déconnexion réussie\n";
        } catch (\Exception $e) {
            if ($this->debug) {
                throw $e;
            }
        }
    }

    public function setDebug($debug) {
        $this->debug = $debug;
        return $this;
    }
} 