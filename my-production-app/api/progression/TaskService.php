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

class TaskService {
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
            'trace' => true
        );

        // Initialisation du service
        $this->service = new ProgressionPortType($opts, $wsdlUrl);
        $this->service->__setLocation($serviceUrl);

        // Préparation des credentials
        $this->credentials = new Credentials();
    }

    public function login($username, $password) {
        $this->credentials->setUsername($username);
        $this->credentials->setPassword($password);
        
        $loginResponse = $this->service->Login(new LoginRequest($this->credentials));
        $this->credentials = $loginResponse->getCredentials();
        return $this;
    }

    public function findTaskByCode($taskCode) {
        if (!$this->credentials) {
            throw new \Exception("Non connecté. Appelez login() d'abord.");
        }

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

        try {
            return $this->service->SearchRecords($searchRequest);
        } catch (\Exception $e) {
            throw new \Exception("Erreur lors de la recherche de la tâche : " . $e->getMessage());
        }
    }

    public function logout() {
        if ($this->credentials) {
            try {
                $this->service->Logout(new LogoutRequest($this->credentials));
                $this->credentials = null;
            } catch (\Exception $e) {
                throw new \Exception("Erreur lors de la déconnexion : " . $e->getMessage());
            }
        }
    }
} 