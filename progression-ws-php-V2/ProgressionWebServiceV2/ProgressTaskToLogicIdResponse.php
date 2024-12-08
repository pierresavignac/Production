<?php

namespace ProgressionWebService;

class ProgressTaskToLogicIdResponse
{

    /**
     * @var RecordRef $taskStateRef
     */
    protected $taskStateRef = null;

    /**
     * @param RecordRef $taskStateRef
     */
    public function __construct($taskStateRef = null)
    {
      $this->taskStateRef = $taskStateRef;
    }

    /**
     * @return RecordRef
     */
    public function getTaskStateRef()
    {
      return $this->taskStateRef;
    }

    /**
     * @param RecordRef $taskStateRef
     * @return \ProgressionWebService\ProgressTaskToLogicIdResponse
     */
    public function setTaskStateRef($taskStateRef)
    {
      $this->taskStateRef = $taskStateRef;
      return $this;
    }

}
