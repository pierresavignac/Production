<?php

namespace ProgressionWebService;

class DispatchTasksResponse
{

    /**
     * @var ArrayOfString $success
     */
    protected $success = null;

    /**
     * @param ArrayOfString $success
     */
    public function __construct($success = null)
    {
      $this->success = $success;
    }

    /**
     * @return ArrayOfString
     */
    public function getSuccess()
    {
      return $this->success;
    }

    /**
     * @param ArrayOfString $success
     * @return \ProgressionWebService\DispatchTasksResponse
     */
    public function setSuccess($success)
    {
      $this->success = $success;
      return $this;
    }

}
