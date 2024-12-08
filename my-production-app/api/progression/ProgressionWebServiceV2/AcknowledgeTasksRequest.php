<?php

namespace ProgressionWebService;

class AcknowledgeTasksRequest
{

    /**
     * @var Credentials $credentials
     */
    protected $credentials = null;

    /**
     * @var ArrayOfRecordRef $taskRefs
     */
    protected $taskRefs = null;

    /**
     * @var \DateTime $datetime
     */
    protected $datetime = null;

    /**
     * @var AcknowledgeType $acknowledgeType
     */
    protected $acknowledgeType = null;

    /**
     * @param Credentials $credentials
     * @param ArrayOfRecordRef $taskRefs
     * @param \DateTime $datetime
     * @param AcknowledgeType $acknowledgeType
     */
    public function __construct($credentials = null, $taskRefs = null, \DateTime $datetime = null, $acknowledgeType = null)
    {
      $this->credentials = $credentials;
      $this->taskRefs = $taskRefs;
      $this->datetime = $datetime ? $datetime->format(\DateTime::ATOM) : null;
      $this->acknowledgeType = $acknowledgeType;
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
     * @return \ProgressionWebService\AcknowledgeTasksRequest
     */
    public function setCredentials($credentials)
    {
      $this->credentials = $credentials;
      return $this;
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
     * @return \ProgressionWebService\AcknowledgeTasksRequest
     */
    public function setTaskRefs($taskRefs)
    {
      $this->taskRefs = $taskRefs;
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
     * @return \ProgressionWebService\AcknowledgeTasksRequest
     */
    public function setDatetime(\DateTime $datetime)
    {
      $this->datetime = $datetime->format(\DateTime::ATOM);
      return $this;
    }

    /**
     * @return AcknowledgeType
     */
    public function getAcknowledgeType()
    {
      return $this->acknowledgeType;
    }

    /**
     * @param AcknowledgeType $acknowledgeType
     * @return \ProgressionWebService\AcknowledgeTasksRequest
     */
    public function setAcknowledgeType($acknowledgeType)
    {
      $this->acknowledgeType = $acknowledgeType;
      return $this;
    }

}
