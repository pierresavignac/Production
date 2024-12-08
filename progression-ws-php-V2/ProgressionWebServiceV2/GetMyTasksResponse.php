<?php

namespace ProgressionWebService;

class GetMyTasksResponse
{

    /**
     * @var ArrayOfRecord $tasks
     */
    protected $tasks = null;

    /**
     * @param ArrayOfRecord $tasks
     */
    public function __construct($tasks = null)
    {
      $this->tasks = $tasks;
    }

    /**
     * @return ArrayOfRecord
     */
    public function getTasks()
    {
      return $this->tasks;
    }

    /**
     * @param ArrayOfRecord $tasks
     * @return \ProgressionWebService\GetMyTasksResponse
     */
    public function setTasks($tasks)
    {
      $this->tasks = $tasks;
      return $this;
    }

}
