<?php

namespace ProgressionWebService;

use ProgressionWebService\Credentials;
use ProgressionWebService\LoginRequest;
use ProgressionWebService\LogoutRequest;
use ProgressionWebService\ProgressionPortType;
use ProgressionWebService\SearchRecordsRequest;
use ProgressionWebService\RecordType;
use ProgressionWebService\ArrayOfProperty;
use ProgressionWebService\Property;

class TaskWrapper {
    private $service;
    private $credentials;
    private $companyDomain;

    public function __construct($config) {
        $this->companyDomain = $config['company_domain'];
        $serverUrl = "https://{$this->companyDomain}.progressionlive.com";
        $serviceUrl = $serverUrl . '/server/ws/v2/ProgressionWebService';
        $wsdlUrl = $serviceUrl . '?wsdl';

        // Configuration du client SOAP
        $opts = array(
            'connection_timeout' => 30,
            'features' => SOAP_SINGLE_ELEMENT_ARRAYS,
            'trace' => true,
            'cache_wsdl' => WSDL_CACHE_NONE  // Désactiver le cache WSDL pendant le développement
        );

        // Initialisation du service avec ProgressionPortType
        $this->service = new ProgressionPortType($opts, $wsdlUrl);
        $this->service->__setLocation($serviceUrl);

        // Préparation des credentials
        $this->credentials = new Credentials();
    }

    public function login($username, $password) {
        try {
            $this->credentials->setUsername($username);
            $this->credentials->setPassword($password);
            
            $loginRequest = new LoginRequest($this->credentials);
            $loginResponse = $this->service->Login($loginRequest);
            
            if (!$loginResponse || !method_exists($loginResponse, 'getCredentials')) {
                throw new \Exception("Réponse de login invalide");
            }
            
            $this->credentials = $loginResponse->getCredentials();
            return $this;
        } catch (\Exception $e) {
            throw new \Exception("Erreur lors de la connexion : " . $e->getMessage());
        }
    }

    public function findTaskByCode($taskCode) {
        if (!$this->credentials) {
            throw new \Exception("Non connecté. Appelez login() d'abord.");
        }

        try {
            $searchRequest = new SearchRecordsRequest();
            $searchRequest->setCredentials($this->credentials);
            $searchRequest->setRecordType(RecordType::TASK);
            $searchRequest->setQuery('code = :code');
            
            $params = new ArrayOfProperty();
            $codeParam = new Property();
            $codeParam->setName('code');
            $codeParam->setValue(new \SoapVar($taskCode, XSD_STRING, 'string', 'http://www.w3.org/2001/XMLSchema'));
            $params->setProperty(array($codeParam));
            $searchRequest->setParameters($params);

            $response = $this->service->SearchRecords($searchRequest);
            
            if (!$response) {
                throw new \Exception("Aucune réponse reçue du service");
            }
            
            return $response;
        } catch (\Exception $e) {
            throw new \Exception("Erreur lors de la recherche de la tâche : " . $e->getMessage());
        }
    }

    public function logout() {
        if ($this->credentials) {
            try {
                $logoutRequest = new LogoutRequest($this->credentials);
                $this->service->Logout($logoutRequest);
                $this->credentials = null;
            } catch (\Exception $e) {
                throw new \Exception("Erreur lors de la déconnexion : " . $e->getMessage());
            }
        }
    }
} 