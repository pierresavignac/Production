<?php

namespace ProgressionWebService;

class ProgressionPortType extends \SoapClient
{

    /**
     * @var array $classmap The defined classes
     */
    private static $classmap = array (
      'WorkflowTransition' => 'ProgressionWebService\\WorkflowTransition',
      'Workflow' => 'ProgressionWebService\\Workflow',
      'WorkflowStep' => 'ProgressionWebService\\WorkflowStep',
      'Tax' => 'ProgressionWebService\\Tax',
      'TaxConfig' => 'ProgressionWebService\\TaxConfig',
      'Task' => 'ProgressionWebService\\Task',
      'TaskState' => 'ProgressionWebService\\TaskState',
      'TaskItemList' => 'ProgressionWebService\\TaskItemList',
      'TaskOptim' => 'ProgressionWebService\\TaskOptim',
      'TaskComment' => 'ProgressionWebService\\TaskComment',
      'TaxAmount' => 'ProgressionWebService\\TaxAmount',
      'TaskPriority' => 'ProgressionWebService\\TaskPriority',
      'TaskItem' => 'ProgressionWebService\\TaskItem',
      'TaskSignature' => 'ProgressionWebService\\TaskSignature',
      'TaskAttachment' => 'ProgressionWebService\\TaskAttachment',
      'TaskSchedule' => 'ProgressionWebService\\TaskSchedule',
      'TaskScheduleTemplate' => 'ProgressionWebService\\TaskScheduleTemplate',
      'TaskItemType' => 'ProgressionWebService\\TaskItemType',
      'TaskType' => 'ProgressionWebService\\TaskType',
      'HumanResourceOptim' => 'ProgressionWebService\\HumanResourceOptim',
      'ResourceAttachment' => 'ProgressionWebService\\ResourceAttachment',
      'HumanResourceAttachment' => 'ProgressionWebService\\HumanResourceAttachment',
      'ResourceType' => 'ProgressionWebService\\ResourceType',
      'HumanResourceType' => 'ProgressionWebService\\HumanResourceType',
      'Resource' => 'ProgressionWebService\\Resource',
      'HumanResource' => 'ProgressionWebService\\HumanResource',
      'HumanResourceDisponibility' => 'ProgressionWebService\\HumanResourceDisponibility',
      'WorkingPlanWindow' => 'ProgressionWebService\\WorkingPlanWindow',
      'WorkingScheduleException' => 'ProgressionWebService\\WorkingScheduleException',
      'Report' => 'ProgressionWebService\\Report',
      'ReportParam' => 'ProgressionWebService\\ReportParam',
      'ReportParamOption' => 'ProgressionWebService\\ReportParamOption',
      'ProductPriceList' => 'ProgressionWebService\\ProductPriceList',
      'Product' => 'ProgressionWebService\\Product',
      'RelatedProduct' => 'ProgressionWebService\\RelatedProduct',
      'ProductCategory' => 'ProgressionWebService\\ProductCategory',
      'ProductPrice' => 'ProgressionWebService\\ProductPrice',
      'ProductImage' => 'ProgressionWebService\\ProductImage',
      'ProductType' => 'ProgressionWebService\\ProductType',
      'OptimTimeWindow' => 'ProgressionWebService\\OptimTimeWindow',
      'OptimResult' => 'ProgressionWebService\\OptimResult',
      'optimLoad' => 'ProgressionWebService\\optimLoad',
      'optimCompetence' => 'ProgressionWebService\\optimCompetence',
      'OptimLoadDimension' => 'ProgressionWebService\\OptimLoadDimension',
      'AssignTasksRequest' => 'ProgressionWebService\\AssignTasksRequest',
      'AssignTasksResponse' => 'ProgressionWebService\\AssignTasksResponse',
      'CreateTaskRequest' => 'ProgressionWebService\\CreateTaskRequest',
      'CreateTaskResponse' => 'ProgressionWebService\\CreateTaskResponse',
      'DispatchTasksRequest' => 'ProgressionWebService\\DispatchTasksRequest',
      'DispatchTasksResponse' => 'ProgressionWebService\\DispatchTasksResponse',
      'GetHumanResourceDisponibilitiesRequest' => 'ProgressionWebService\\GetHumanResourceDisponibilitiesRequest',
      'GetHumanResourceDisponibilitiesResponse' => 'ProgressionWebService\\GetHumanResourceDisponibilitiesResponse',
      'GetMyProfileRequest' => 'ProgressionWebService\\GetMyProfileRequest',
      'GetMyProfileResponse' => 'ProgressionWebService\\GetMyProfileResponse',
      'ImportFileRequest' => 'ProgressionWebService\\ImportFileRequest',
      'ImportFileResponse' => 'ProgressionWebService\\ImportFileResponse',
      'UpdateRecordsFieldsRequest' => 'ProgressionWebService\\UpdateRecordsFieldsRequest',
      'recordFields' => 'ProgressionWebService\\recordFields',
      'UpdateRecordsFieldsResponse' => 'ProgressionWebService\\UpdateRecordsFieldsResponse',
      'ChangePasswordRequest' => 'ProgressionWebService\\ChangePasswordRequest',
      'ChangePasswordResponse' => 'ProgressionWebService\\ChangePasswordResponse',
      'ProgressionWebServiceFault' => 'ProgressionWebService\\ProgressionWebServiceFault',
      'UpdateDisponibilityRequest' => 'ProgressionWebService\\UpdateDisponibilityRequest',
      'UpdateDisponibilityResponse' => 'ProgressionWebService\\UpdateDisponibilityResponse',
      'AcknowledgeTasksRequest' => 'ProgressionWebService\\AcknowledgeTasksRequest',
      'AcknowledgeTasksResponse' => 'ProgressionWebService\\AcknowledgeTasksResponse',
      'UpdateMyDisponibilityRequest' => 'ProgressionWebService\\UpdateMyDisponibilityRequest',
      'UpdateMyDisponibilityResponse' => 'ProgressionWebService\\UpdateMyDisponibilityResponse',
      'GetMyTasksRequest' => 'ProgressionWebService\\GetMyTasksRequest',
      'SearchLimit' => 'ProgressionWebService\\SearchLimit',
      'GetMyTasksResponse' => 'ProgressionWebService\\GetMyTasksResponse',
      'UpdateMyLocationRequest' => 'ProgressionWebService\\UpdateMyLocationRequest',
      'UpdateMyLocationResponse' => 'ProgressionWebService\\UpdateMyLocationResponse',
      'SearchRecordsRequest' => 'ProgressionWebService\\SearchRecordsRequest',
      'SearchLocation' => 'ProgressionWebService\\SearchLocation',
      'SearchRecordsResponse' => 'ProgressionWebService\\SearchRecordsResponse',
      'GetRecordsRequest' => 'ProgressionWebService\\GetRecordsRequest',
      'GetRecordsResponse' => 'ProgressionWebService\\GetRecordsResponse',
      'CreateRecordRequest' => 'ProgressionWebService\\CreateRecordRequest',
      'CreateRecordResponse' => 'ProgressionWebService\\CreateRecordResponse',
      'ProgressTaskToLogicIdRequest' => 'ProgressionWebService\\ProgressTaskToLogicIdRequest',
      'ProgressTaskToLogicIdResponse' => 'ProgressionWebService\\ProgressTaskToLogicIdResponse',
      'UpdateRecordFieldsRequest' => 'ProgressionWebService\\UpdateRecordFieldsRequest',
      'UpdateRecordFieldsResponse' => 'ProgressionWebService\\UpdateRecordFieldsResponse',
      'DeleteRecordRequest' => 'ProgressionWebService\\DeleteRecordRequest',
      'DeleteRecordResponse' => 'ProgressionWebService\\DeleteRecordResponse',
      'LogoutRequest' => 'ProgressionWebService\\LogoutRequest',
      'LogoutResponse' => 'ProgressionWebService\\LogoutResponse',
      'SearchRecordRefsResponse' => 'ProgressionWebService\\SearchRecordRefsResponse',
      'ProgressTaskRequest' => 'ProgressionWebService\\ProgressTaskRequest',
      'ProgressTaskResponse' => 'ProgressionWebService\\ProgressTaskResponse',
      'GetMyTaskRefsResponse' => 'ProgressionWebService\\GetMyTaskRefsResponse',
      'EchoRequest' => 'ProgressionWebService\\EchoRequest',
      'EchoResponse' => 'ProgressionWebService\\EchoResponse',
      'SearchFilterRequest' => 'ProgressionWebService\\SearchFilterRequest',
      'GetRecordRequest' => 'ProgressionWebService\\GetRecordRequest',
      'GetRecordResponse' => 'ProgressionWebService\\GetRecordResponse',
      'LoginRequest' => 'ProgressionWebService\\LoginRequest',
      'LoginResponse' => 'ProgressionWebService\\LoginResponse',
      'UpdateRecordRequest' => 'ProgressionWebService\\UpdateRecordRequest',
      'UpdateRecordResponse' => 'ProgressionWebService\\UpdateRecordResponse',
      'GetFilesDataRequest' => 'ProgressionWebService\\GetFilesDataRequest',
      'GetFilesDataResponse' => 'ProgressionWebService\\GetFilesDataResponse',
      'UpdateRecordFieldRequest' => 'ProgressionWebService\\UpdateRecordFieldRequest',
      'UpdateRecordFieldResponse' => 'ProgressionWebService\\UpdateRecordFieldResponse',
      'Location' => 'ProgressionWebService\\Location',
      'ResourceLocation' => 'ProgressionWebService\\ResourceLocation',
      'HumanResourceLocation' => 'ProgressionWebService\\HumanResourceLocation',
      'Disponibility' => 'ProgressionWebService\\Disponibility',
      'MobileConf' => 'ProgressionWebService\\MobileConf',
      'Node' => 'ProgressionWebService\\Node',
      'Client' => 'ProgressionWebService\\Client',
      'ClientAttachment' => 'ProgressionWebService\\ClientAttachment',
      'NodeAttachment' => 'ProgressionWebService\\NodeAttachment',
      'ClientType' => 'ProgressionWebService\\ClientType',
      'NodeType' => 'ProgressionWebService\\NodeType',
      'RecordRef' => 'ProgressionWebService\\RecordRef',
      'ArrayOfRecordRef' => 'ProgressionWebService\\ArrayOfRecordRef',
      'ArrayOfRecord' => 'ProgressionWebService\\ArrayOfRecord',
      'Record' => 'ProgressionWebService\\Record',
      'ArrayOfProperty' => 'ProgressionWebService\\ArrayOfProperty',
      'Property' => 'ProgressionWebService\\Property',
      'RecordField' => 'ProgressionWebService\\RecordField',
      'FileData' => 'ProgressionWebService\\FileData',
      'PropertyDefinition' => 'ProgressionWebService\\PropertyDefinition',
      'PropertyConfiguration' => 'ProgressionWebService\\PropertyConfiguration',
      'ArrayOfInt' => 'ProgressionWebService\\ArrayOfInt',
      'PropertyGroup' => 'ProgressionWebService\\PropertyGroup',
      'PropertyConfigurations' => 'ProgressionWebService\\PropertyConfigurations',
      'Tag' => 'ProgressionWebService\\Tag',
      'PropertyOptionsList' => 'ProgressionWebService\\PropertyOptionsList',
      'ArrayOfString' => 'ProgressionWebService\\ArrayOfString',
      'Address' => 'ProgressionWebService\\Address',
      'Position' => 'ProgressionWebService\\Position',
      'Comment' => 'ProgressionWebService\\Comment',
      'DynamicEntityComment' => 'ProgressionWebService\\DynamicEntityComment',
      'Attachment' => 'ProgressionWebService\\Attachment',
      'DynamicEntityAttachment' => 'ProgressionWebService\\DynamicEntityAttachment',
      'Type' => 'ProgressionWebService\\Type',
      'DynamicEntityType' => 'ProgressionWebService\\DynamicEntityType',
      'DynamicEntity' => 'ProgressionWebService\\DynamicEntity',
      'Message' => 'ProgressionWebService\\Message',
      'MessageRecipient' => 'ProgressionWebService\\MessageRecipient',
      'MessageAttachment' => 'ProgressionWebService\\MessageAttachment',
      'ArrayOfRecordField' => 'ProgressionWebService\\ArrayOfRecordField',
      'EntityFilter' => 'ProgressionWebService\\EntityFilter',
      'ArrayOfFilter' => 'ProgressionWebService\\ArrayOfFilter',
      'Filter' => 'ProgressionWebService\\Filter',
      'Todo' => 'ProgressionWebService\\Todo',
      'Contact' => 'ProgressionWebService\\Contact',
      'Credentials' => 'ProgressionWebService\\Credentials',
      'User' => 'ProgressionWebService\\User',
      'Cie' => 'ProgressionWebService\\Cie',
      'ArrayOfCieConfig' => 'ProgressionWebService\\ArrayOfCieConfig',
      'CieConfig' => 'ProgressionWebService\\CieConfig',
      'CieConfigKey' => 'ProgressionWebService\\CieConfigKey',
      'Role' => 'ProgressionWebService\\Role',
      'EntityPermission' => 'ProgressionWebService\\EntityPermission',
      'Profile' => 'ProgressionWebService\\Profile',
      'CieAttachment' => 'ProgressionWebService\\CieAttachment',
    );

    /**
     * @param array $options A array of config values
     * @param string $wsdl The wsdl file to use
     */
    public function __construct(array $options = array(), $wsdl = 'http://app.progressionlive.com/server/ws/v2/ProgressionWebService?wsdl')
    {
      foreach (self::$classmap as $key => $value) {
        if (!isset($options['classmap'][$key])) {
          $options['classmap'][$key] = $value;
        }
      }
      $options = array_merge(array (
      'features' => 1,
    ), $options);
      parent::__construct($wsdl, $options);
    }

    /**
     * @param ChangePasswordRequest $parameters
     * @return ChangePasswordResponse
     */
    public function ChangePassword(ChangePasswordRequest $parameters)
    {
      return $this->__soapCall('ChangePassword', array($parameters));
    }

    /**
     * @param UpdateMyDisponibilityRequest $parameters
     * @return UpdateMyDisponibilityResponse
     */
    public function UpdateMyDisponibility(UpdateMyDisponibilityRequest $parameters)
    {
      return $this->__soapCall('UpdateMyDisponibility', array($parameters));
    }

    /**
     * @param AcknowledgeTasksRequest $parameters
     * @return AcknowledgeTasksResponse
     */
    public function AcknowledgeTasks(AcknowledgeTasksRequest $parameters)
    {
      return $this->__soapCall('AcknowledgeTasks', array($parameters));
    }

    /**
     * @param UpdateMyLocationRequest $parameters
     * @return UpdateMyLocationResponse
     */
    public function UpdateMyLocation(UpdateMyLocationRequest $parameters)
    {
      return $this->__soapCall('UpdateMyLocation', array($parameters));
    }

    /**
     * @param GetMyTasksRequest $parameters
     * @return GetMyTasksResponse
     */
    public function GetMyTasks(GetMyTasksRequest $parameters)
    {
      return $this->__soapCall('GetMyTasks', array($parameters));
    }

    /**
     * @param SearchRecordsRequest $parameters
     * @return SearchRecordsResponse
     */
    public function SearchRecords(SearchRecordsRequest $parameters)
    {
      return $this->__soapCall('SearchRecords', array($parameters));
    }

    /**
     * @param GetRecordsRequest $parameters
     * @return GetRecordsResponse
     */
    public function GetRecords(GetRecordsRequest $parameters)
    {
      return $this->__soapCall('GetRecords', array($parameters));
    }

    /**
     * @param ProgressTaskToLogicIdRequest $parameters
     * @return ProgressTaskToLogicIdResponse
     */
    public function ProgressTaskToLogicId(ProgressTaskToLogicIdRequest $parameters)
    {
      return $this->__soapCall('ProgressTaskToLogicId', array($parameters));
    }

    /**
     * @param CreateRecordRequest $parameters
     * @return CreateRecordResponse
     */
    public function CreateRecord(CreateRecordRequest $parameters)
    {
      return $this->__soapCall('CreateRecord', array($parameters));
    }

    /**
     * @param UpdateRecordFieldsRequest $parameters
     * @return UpdateRecordFieldsResponse
     */
    public function UpdateRecordFields(UpdateRecordFieldsRequest $parameters)
    {
      return $this->__soapCall('UpdateRecordFields', array($parameters));
    }

    /**
     * @param DeleteRecordRequest $parameters
     * @return DeleteRecordResponse
     */
    public function DeleteRecord(DeleteRecordRequest $parameters)
    {
      return $this->__soapCall('DeleteRecord', array($parameters));
    }

    /**
     * @param GetMyProfileRequest $parameters
     * @return GetMyProfileResponse
     */
    public function GetMyProfile(GetMyProfileRequest $parameters)
    {
      return $this->__soapCall('GetMyProfile', array($parameters));
    }

    /**
     * @param LogoutRequest $parameters
     * @return LogoutResponse
     */
    public function Logout(LogoutRequest $parameters)
    {
      return $this->__soapCall('Logout', array($parameters));
    }

    /**
     * @param DispatchTasksRequest $parameters
     * @return DispatchTasksResponse
     */
    public function DispatchTasks(DispatchTasksRequest $parameters)
    {
      return $this->__soapCall('DispatchTasks', array($parameters));
    }

    /**
     * @param ImportFileRequest $parameters
     * @return ImportFileResponse
     */
    public function ImportFile(ImportFileRequest $parameters)
    {
      return $this->__soapCall('ImportFile', array($parameters));
    }

    /**
     * @param SearchRecordsRequest $parameters
     * @return SearchRecordRefsResponse
     */
    public function SearchRecordRefs(SearchRecordsRequest $parameters)
    {
      return $this->__soapCall('SearchRecordRefs', array($parameters));
    }

    /**
     * @param ProgressTaskRequest $parameters
     * @return ProgressTaskResponse
     */
    public function ProgressTask(ProgressTaskRequest $parameters)
    {
      return $this->__soapCall('ProgressTask', array($parameters));
    }

    /**
     * @param GetMyTasksRequest $parameters
     * @return GetMyTaskRefsResponse
     */
    public function GetMyTaskRefs(GetMyTasksRequest $parameters)
    {
      return $this->__soapCall('GetMyTaskRefs', array($parameters));
    }

    /**
     * @param EchoRequest $parameters
     * @return EchoResponse
     */
    public function aEcho(EchoRequest $parameters)
    {
      return $this->__soapCall('Echo', array($parameters));
    }

    /**
     * @param SearchFilterRequest $parameters
     * @return SearchRecordsResponse
     */
    public function SearchRecordsWithFilter(SearchFilterRequest $parameters)
    {
      return $this->__soapCall('SearchRecordsWithFilter', array($parameters));
    }

    /**
     * @param GetRecordRequest $parameters
     * @return GetRecordResponse
     */
    public function GetRecord(GetRecordRequest $parameters)
    {
      return $this->__soapCall('GetRecord', array($parameters));
    }

    /**
     * @param LoginRequest $parameters
     * @return LoginResponse
     */
    public function Login(LoginRequest $parameters)
    {
      return $this->__soapCall('Login', array($parameters));
    }

    /**
     * @param UpdateRecordRequest $parameters
     * @return UpdateRecordResponse
     */
    public function UpdateRecord(UpdateRecordRequest $parameters)
    {
      return $this->__soapCall('UpdateRecord', array($parameters));
    }

    /**
     * @param GetFilesDataRequest $parameters
     * @return GetFilesDataResponse
     */
    public function GetFilesData(GetFilesDataRequest $parameters)
    {
      return $this->__soapCall('GetFilesData', array($parameters));
    }

    /**
     * @param CreateTaskRequest $parameters
     * @return CreateTaskResponse
     */
    public function CreateTask(CreateTaskRequest $parameters)
    {
      return $this->__soapCall('CreateTask', array($parameters));
    }

    /**
     * @param AssignTasksRequest $parameters
     * @return AssignTasksResponse
     */
    public function AssignTasks(AssignTasksRequest $parameters)
    {
      return $this->__soapCall('AssignTasks', array($parameters));
    }

    /**
     * @param UpdateRecordFieldRequest $parameters
     * @return UpdateRecordFieldResponse
     */
    public function UpdateRecordField(UpdateRecordFieldRequest $parameters)
    {
      return $this->__soapCall('UpdateRecordField', array($parameters));
    }

    /**
     * @param GetHumanResourceDisponibilitiesRequest $parameters
     * @return GetHumanResourceDisponibilitiesResponse
     */
    public function GetHumanResourceDisponibilities(GetHumanResourceDisponibilitiesRequest $parameters)
    {
      return $this->__soapCall('GetHumanResourceDisponibilities', array($parameters));
    }

    /**
     * @param UpdateRecordsFieldsRequest $parameters
     * @return UpdateRecordsFieldsResponse
     */
    public function UpdateRecordsFields(UpdateRecordsFieldsRequest $parameters)
    {
      return $this->__soapCall('UpdateRecordsFields', array($parameters));
    }

}
