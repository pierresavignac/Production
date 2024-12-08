<?php

namespace ProgressionWebService;

class ProgressTaskResponse
{

    /**
     * @var RecordRef $taskStateRef
     */
    protected $taskStateRef = null;

    /**
     * @var RecordRef $disponibilityRef
     */
    protected $disponibilityRef = null;

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
     * @return \ProgressionWebService\ProgressTaskResponse
     */
    public function setTaskStateRef($taskStateRef)
    {
      $this->taskStateRef = $taskStateRef;
      return $this;
    }

    /**
     * @return RecordRef
     */
    public function getDisponibilityRef()
    {
      return $this->disponibilityRef;
    }

    /**
     * @param RecordRef $disponibilityRef
     * @return \ProgressionWebService\ProgressTaskResponse
     */
    public function setDisponibilityRef($disponibilityRef)
    {
      $this->disponibilityRef = $disponibilityRef;
      return $this;
    }

}
