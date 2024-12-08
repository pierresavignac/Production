<?php

namespace ProgressionWebService;

class CreateTaskRequest
{

    /**
     * @var Credentials $credentials
     */
    protected $credentials = null;

    /**
     * @var Task $task
     */
    protected $task = null;

    /**
     * @var Location $location
     */
    protected $location = null;

    /**
     * @var boolean $dispatch
     */
    protected $dispatch = null;

    /**
     * @param Credentials $credentials
     * @param Task $task
     * @param Location $location
     * @param boolean $dispatch
     */
    public function __construct($credentials = null, $task = null, $location = null, $dispatch = null)
    {
      $this->credentials = $credentials;
      $this->task = $task;
      $this->location = $location;
      $this->dispatch = $dispatch;
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
     * @return \ProgressionWebService\CreateTaskRequest
     */
    public function setCredentials($credentials)
    {
      $this->credentials = $credentials;
      return $this;
    }

    /**
     * @return Task
     */
    public function getTask()
    {
      return $this->task;
    }

    /**
     * @param Task $task
     * @return \ProgressionWebService\CreateTaskRequest
     */
    public function setTask($task)
    {
      $this->task = $task;
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
     * @return \ProgressionWebService\CreateTaskRequest
     */
    public function setLocation($location)
    {
      $this->location = $location;
      return $this;
    }

    /**
     * @return boolean
     */
    public function getDispatch()
    {
      return $this->dispatch;
    }

    /**
     * @param boolean $dispatch
     * @return \ProgressionWebService\CreateTaskRequest
     */
    public function setDispatch($dispatch)
    {
      $this->dispatch = $dispatch;
      return $this;
    }

}
