<?php

namespace ProgressionWebService;

class GetMyTaskRefsResponse
{

    /**
     * @var ArrayOfRecordRef $taskRefs
     */
    protected $taskRefs = null;

    /**
     * @param ArrayOfRecordRef $taskRefs
     */
    public function __construct($taskRefs = null)
    {
      $this->taskRefs = $taskRefs;
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
     * @return \ProgressionWebService\GetMyTaskRefsResponse
     */
    public function setTaskRefs($taskRefs)
    {
      $this->taskRefs = $taskRefs;
      return $this;
    }

}
