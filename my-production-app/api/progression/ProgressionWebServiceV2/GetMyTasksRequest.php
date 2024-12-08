<?php

namespace ProgressionWebService;

class GetMyTasksRequest
{

    /**
     * @var Credentials $credentials
     */
    protected $credentials = null;

    /**
     * @var SearchLimit $limit
     */
    protected $limit = null;

    /**
     * @var boolean $includeAlreadySentTasks
     */
    protected $includeAlreadySentTasks = null;

    /**
     * @param Credentials $credentials
     * @param boolean $includeAlreadySentTasks
     */
    public function __construct($credentials = null, $includeAlreadySentTasks = null)
    {
      $this->credentials = $credentials;
      $this->includeAlreadySentTasks = $includeAlreadySentTasks;
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
     * @return \ProgressionWebService\GetMyTasksRequest
     */
    public function setCredentials($credentials)
    {
      $this->credentials = $credentials;
      return $this;
    }

    /**
     * @return SearchLimit
     */
    public function getLimit()
    {
      return $this->limit;
    }

    /**
     * @param SearchLimit $limit
     * @return \ProgressionWebService\GetMyTasksRequest
     */
    public function setLimit($limit)
    {
      $this->limit = $limit;
      return $this;
    }

    /**
     * @return boolean
     */
    public function getIncludeAlreadySentTasks()
    {
      return $this->includeAlreadySentTasks;
    }

    /**
     * @param boolean $includeAlreadySentTasks
     * @return \ProgressionWebService\GetMyTasksRequest
     */
    public function setIncludeAlreadySentTasks($includeAlreadySentTasks)
    {
      $this->includeAlreadySentTasks = $includeAlreadySentTasks;
      return $this;
    }

}
