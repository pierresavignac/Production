<?php

namespace ProgressionWebService;

class CreateTaskResponse
{

    /**
     * @var RecordRef $taskRef
     */
    protected $taskRef = null;

    /**
     * @param RecordRef $taskRef
     */
    public function __construct($taskRef = null)
    {
      $this->taskRef = $taskRef;
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
     * @return \ProgressionWebService\CreateTaskResponse
     */
    public function setTaskRef($taskRef)
    {
      $this->taskRef = $taskRef;
      return $this;
    }

}
