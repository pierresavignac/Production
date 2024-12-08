<?php

date_default_timezone_set('America/Montreal');

require_once __DIR__ . '/ProgressionWebServiceV2/autoload.php';
require_once __DIR__ . '/ProgressionWebServiceV2/Utils.php';

use ProgressionWebService\ArrayOfProperty;
use ProgressionWebService\CreateRecordRequest;
use ProgressionWebService\CreateTaskRequest;
use ProgressionWebService\Credentials;
use ProgressionWebService\LoginRequest;
use ProgressionWebService\LogoutRequest;
use ProgressionWebService\ProgressionPortType;
use ProgressionWebService\Property;
use ProgressionWebService\RecordRef;
use ProgressionWebService\RecordType;
use ProgressionWebService\SearchRecordsRequest;
use ProgressionWebService\Task;
use ProgressionWebService\TaskAttachment;

//////////////////////////////////////////////////
// Progression Web Service

$serverUrl = 'http://support.progressionlive.com';
$serviceUrl = $serverUrl . '/server/ws/v2/ProgressionWebService';
$wsdlUrl = $serviceUrl . '?wsdl';

$service = new ProgressionPortType(array(), $wsdlUrl);
$service->__setLocation($serviceUrl);

//////////////////////////////////////////////////
// Credentials

$credentials = new Credentials();
$credentials->setUsername('*USERNAME*');
$credentials->setPassword('*PASSWORD*');

//////////////////////////////////////////////////
// Login

$loginResponse = $service->Login(new LoginRequest($credentials));
$credentials = $loginResponse->getCredentials();

//////////////////////////////////////////////////
// Recherche de type de tâche

$searchTaskTypeRefsRequest = new SearchRecordsRequest();
$searchTaskTypeRefsRequest->setCredentials($credentials);
$searchTaskTypeRefsRequest->setRecordType(RecordType::TASK_TYPE);
$searchTaskTypeRefsRequest->setQuery('defaultType = 1');

$searchTaskTypeRefsResponse = $service->SearchRecordRefs($searchTaskTypeRefsRequest);
$taskTypeRefs = $searchTaskTypeRefsResponse->getRecordRefs()->getRecordRef();
if (count($taskTypeRefs) == 0)
    die('No default task type');

$taskTypeRef = $taskTypeRefs[0];
echo 'Found task type id: ' . $taskTypeRef->getId() . "\n";

//////////////////////////////////////////////////
// Recherche de client

$searchClientRefsRequest = new SearchRecordsRequest();
$searchClientRefsRequest->setCredentials($credentials);
$searchClientRefsRequest->setRecordType(RecordType::CLIENT);
$searchClientRefsRequest->setQuery('label = :label');
$searchClientRefsRequest->setParameters(new ArrayOfProperty());
$searchClientRefsRequest->getParameters()->setProperty(array(
    (new Property())->setName('label')->setValue(new SoapVar('Diffusion', XSD_STRING, 'string', 'http://www.w3.org/2001/XMLSchema'))
));

$searchClientRefsResponse = $service->SearchRecordRefs($searchClientRefsRequest);
$clientRefs = $searchClientRefsResponse->getRecordRefs()->getRecordRef();
if (count($clientRefs) == 0)
    die('No client Diffusion');

$clientRef = $clientRefs[0];
echo 'Found client id: ' . $clientRef->getId() . "\n";

//////////////////////////////////////////////////
// Création de tâche

$task = new Task();
$task->setTypeRef($taskTypeRef);
$task->setClientRef($clientRef);
$task->setRv(new DateTime());
$task->setSummary('Un sommaire');
$task->setDescription('Une description');
$task->setProperties(new ArrayOfProperty());
$task->getProperties()->setProperty(array(
    (new Property())->setName('infos.customerOrderNumber')->setValue(new SoapVar('Un champ dynamique', XSD_STRING, 'string', 'http://www.w3.org/2001/XMLSchema')),
    (new Property())->setName('infos.comment')->setValue(new SoapVar('Un autre champ dynamique', XSD_STRING, 'string', 'http://www.w3.org/2001/XMLSchema'))
));

$createTaskRequest = new CreateTaskRequest();
$createTaskRequest->setCredentials($credentials);
$createTaskRequest->setTask($task);

$createTaskResponse = $service->CreateTask($createTaskRequest);
$taskRef = $createTaskResponse->getTaskRef();
echo 'Created task id (code): ' . $taskRef->getId() . ' (' . $taskRef->getLabel() . ')' . "\n";

//////////////////////////////////////////////////
// Joindre un fichier à la tâche

// ici './test.jpg' est le chemin relatif du fichier à envoyer,
// passé à la fonction realpath, pour avoir son chemin absolu
$attachmentFilePath = realpath('./test.jpg');

// le type d'attachement par default
$attachmentTypeRef = new RecordRef();
$attachmentTypeRef->setType(RecordType::ATTACHMENT_TYPE);
$attachmentTypeRef->setLabel('generic');

// les détails de l'attachement
$taskAttachment = new TaskAttachment();
$taskAttachment->setTypeRef($attachmentTypeRef);
$taskAttachment->setName('test.jpg');
$taskAttachment->setContentType('image/jpeg');
$taskAttachment->setSize(filesize($attachmentFilePath));
$taskAttachment->setData(file_get_contents($attachmentFilePath));

// la requête pour créer l'attachement
$createAttachmentRequest = new CreateRecordRequest();
$createAttachmentRequest->setCredentials($credentials);
$createAttachmentRequest->setParentRecordRef($taskRef);
$createAttachmentRequest->setRecord($taskAttachment);

// exécution de la requête
$createAttachmentResponse = $service->CreateRecord($createAttachmentRequest);
echo 'Created task attachment id: ' . $createAttachmentResponse->getRecordRef()->getId() . "\n";

//////////////////////////////////////////////////
// Logout

$logoutResponse = $service->Logout(new LogoutRequest($credentials));
