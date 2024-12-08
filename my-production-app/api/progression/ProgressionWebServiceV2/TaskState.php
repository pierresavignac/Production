<?php

namespace ProgressionWebService;

class TaskState extends Record
{

    /**
     * @var RecordRef $WorkflowStepRef
     */
    protected $WorkflowStepRef = null;

    /**
     * @var \DateTime $Datetime
     */
    protected $Datetime = null;

    /**
     * @var Location $location
     */
    protected $location = null;

    /**
     * @var int $LogicId
     */
    protected $LogicId = null;

    /**
     * @var RecordRef $HumanResourceRef
     */
    protected $HumanResourceRef = null;

    /**
     * @var RecordRef $UserRef
     */
    protected $UserRef = null;

    /**
     * @param int $Id
     * @param string $UID
     * @param string $ExternalId
     * @param \DateTime $removed
     * @param anySimpleType $updated
     * @param anySimpleType $created
     * @param RecordRef $WorkflowStepRef
     * @param \DateTime $Datetime
     */
    public function __construct(?string $Id, ?string $UID, ?string $ExternalId, ?\DateTime $removed, ?string $updated, ?string $created, ?string $WorkflowStepRef, \DateTime $Datetime = null)
    {
      parent::__construct($Id, $UID, $ExternalId, $removed, $updated, $created);
      $this->WorkflowStepRef = $WorkflowStepRef;
      $this->Datetime = $Datetime ? $Datetime->format(\DateTime::ATOM) : null;
    }

    /**
     * @return RecordRef
     */
    public function getWorkflowStepRef()
    {
      return $this->WorkflowStepRef;
    }

    /**
     * @param RecordRef $WorkflowStepRef
     * @return \ProgressionWebService\TaskState
     */
    public function setWorkflowStepRef(?\RecordRef $WorkflowStepRef)
    {
      $this->WorkflowStepRef = $WorkflowStepRef;
      return $this;
    }

    /**
     * @return \DateTime
     */
    public function getDatetime()
    {
      if ($this->Datetime == null) {
        return null;
      } else {
        try {
          return new \DateTime($this->Datetime);
        } catch (\Exception $e) {
          return false;
        }
      }
    }

    /**
     * @param \DateTime $Datetime
     * @return \ProgressionWebService\TaskState
     */
    public function setDatetime(\DateTime $Datetime)
    {
      $this->Datetime = $Datetime->format(\DateTime::ATOM);
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
     * @return \ProgressionWebService\TaskState
     */
    public function setLocation(?\RecordRef $location)
    {
      $this->location = $location;
      return $this;
    }

    /**
     * @return int
     */
    public function getLogicId()
    {
      return $this->LogicId;
    }

    /**
     * @param int $LogicId
     * @return \ProgressionWebService\TaskState
     */
    public function setLogicId(?\RecordRef $LogicId)
    {
      $this->LogicId = $LogicId;
      return $this;
    }

    /**
     * @return RecordRef
     */
    public function getHumanResourceRef()
    {
      return $this->HumanResourceRef;
    }

    /**
     * @param RecordRef $HumanResourceRef
     * @return \ProgressionWebService\TaskState
     */
    public function setHumanResourceRef(?\RecordRef $HumanResourceRef)
    {
      $this->HumanResourceRef = $HumanResourceRef;
      return $this;
    }

    /**
     * @return RecordRef
     */
    public function getUserRef()
    {
      return $this->UserRef;
    }

    /**
     * @param RecordRef $UserRef
     * @return \ProgressionWebService\TaskState
     */
    public function setUserRef(?\RecordRef $UserRef)
    {
      $this->UserRef = $UserRef;
      return $this;
    }

}
