<?php

namespace ProgressionWebService;

class ProgressTaskToLogicIdRequest
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
     * @var int $logicId
     */
    protected $logicId = null;

    /**
     * @var \DateTime $datetime
     */
    protected $datetime = null;

    /**
     * @param Credentials $credentials
     * @param RecordRef $taskRef
     * @param int $logicId
     * @param \DateTime $datetime
     */
    public function __construct($credentials = null, $taskRef = null, $logicId = null, \DateTime $datetime = null)
    {
      $this->credentials = $credentials;
      $this->taskRef = $taskRef;
      $this->logicId = $logicId;
      $this->datetime = $datetime ? $datetime->format(\DateTime::ATOM) : null;
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
     * @return \ProgressionWebService\ProgressTaskToLogicIdRequest
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
     * @return \ProgressionWebService\ProgressTaskToLogicIdRequest
     */
    public function setTaskRef($taskRef)
    {
      $this->taskRef = $taskRef;
      return $this;
    }

    /**
     * @return int
     */
    public function getLogicId()
    {
      return $this->logicId;
    }

    /**
     * @param int $logicId
     * @return \ProgressionWebService\ProgressTaskToLogicIdRequest
     */
    public function setLogicId($logicId)
    {
      $this->logicId = $logicId;
      return $this;
    }

    /**
     * @return \DateTime
     */
    public function getDatetime()
    {
      if ($this->datetime == null) {
        return null;
      } else {
        try {
          return new \DateTime($this->datetime);
        } catch (\Exception $e) {
          return false;
        }
      }
    }

    /**
     * @param \DateTime $datetime
     * @return \ProgressionWebService\ProgressTaskToLogicIdRequest
     */
    public function setDatetime(\DateTime $datetime)
    {
      $this->datetime = $datetime->format(\DateTime::ATOM);
      return $this;
    }

}
