<?php

namespace ProgressionWebService;

class AssignTasksRequest
{

    /**
     * @var Credentials $credentials
     */
    protected $credentials = null;

    /**
     * @var ArrayOfRecordRef $taskRefs
     */
    protected $taskRefs = null;

    /**
     * @var RecordRef $humanResourceRef
     */
    protected $humanResourceRef = null;

    /**
     * @param Credentials $credentials
     * @param ArrayOfRecordRef $taskRefs
     * @param RecordRef $humanResourceRef
     */
    public function __construct($credentials = null, $taskRefs = null, $humanResourceRef = null)
    {
      $this->credentials = $credentials;
      $this->taskRefs = $taskRefs;
      $this->humanResourceRef = $humanResourceRef;
    }

    /**
     * @return Credentials
     */
    public function getCredentials()
    {
      return $this->credentials;
    }

    /**
     * @param Credentials $credentials
     * @return \ProgressionWebService\AssignTasksRequest
     */
    public function setCredentials($credentials)
    {
      $this->credentials = $credentials;
      return $this;
    }

    /**
     * @return ArrayOfRecordRef
     */
    public function getTaskRefs()
    {
      return $this->taskRefs;
    }

    /**
     * @param ArrayOfRecordRef $taskRefs
     * @return \ProgressionWebService\AssignTasksRequest
     */
    public function setTaskRefs($taskRefs)
    {
      $this->taskRefs = $taskRefs;
      return $this;
    }

    /**
     * @return RecordRef
     */
    public function getHumanResourceRef()
    {
      return $this->humanResourceRef;
    }

    /**
     * @param RecordRef $humanResourceRef
     * @return \ProgressionWebService\AssignTasksRequest
     */
    public function setHumanResourceRef($humanResourceRef)
    {
      $this->humanResourceRef = $humanResourceRef;
      return $this;
    }

}
