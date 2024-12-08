<?php

namespace ProgressionWebService;

class ProgressTaskRequest
{

    /**
     * @var Credentials $credentials
     */
    protected $credentials = null;

    /**
     * @var RecordRef $taskRef
     */
    protected $taskRef = null;

    /**
     * @var TaskState $taskState
     */
    protected $taskState = null;

    /**
     * @var Location $location
     */
    protected $location = null;

    /**
     * @param Credentials $credentials
     * @param RecordRef $taskRef
     * @param TaskState $taskState
     */
    public function __construct($credentials = null, $taskRef = null, $taskState = null)
    {
      $this->credentials = $credentials;
      $this->taskRef = $taskRef;
      $this->taskState = $taskState;
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
     * @return \ProgressionWebService\ProgressTaskRequest
     */
    public function setCredentials($credentials)
    {
      $this->credentials = $credentials;
      return $this;
    }

    /**
     * @return RecordRef
     */
    public function getTaskRef()
    {
      return $this->taskRef;
    }

    /**
     * @param RecordRef $taskRef
     * @return \ProgressionWebService\ProgressTaskRequest
     */
    public function setTaskRef($taskRef)
    {
      $this->taskRef = $taskRef;
      return $this;
    }

    /**
     * @return TaskState
     */
    public function getTaskState()
    {
      return $this->taskState;
    }

    /**
     * @param TaskState $taskState
     * @return \ProgressionWebService\ProgressTaskRequest
     */
    public function setTaskState($taskState)
    {
      $this->taskState = $taskState;
      return $this;
    }

    /**
     * @return Location
     */
    public function getLocation()
    {
      return $this->location;
    }

    /**
     * @param Location $location
     * @return \ProgressionWebService\ProgressTaskRequest
     */
    public function setLocation($location)
    {
      $this->location = $location;
      return $this;
    }

}
