<?php

namespace ProgressionWebService;

class WorkflowTransition extends Record
{

    /**
     * @var RecordRef $FromStepRef
     */
    protected $FromStepRef = null;

    /**
     * @var RecordRef $ToStepRef
     */
    protected $ToStepRef = null;

    /**
     * @var boolean $UserCanTransition
     */
    protected $UserCanTransition = null;

    /**
     * @param int $Id
     * @param string $UID
     * @param string $ExternalId
     * @param \DateTime $removed
     * @param anySimpleType $updated
     * @param anySimpleType $created
     * @param RecordRef $FromStepRef
     * @param RecordRef $ToStepRef
     * @param boolean $UserCanTransition
     */
    public function __construct($Id = null, $UID = null, $ExternalId = null, \DateTime $removed = null, $updated = null, $created = null, $FromStepRef = null, $ToStepRef = null, $UserCanTransition = null)
    {
      parent::__construct($Id, $UID, $ExternalId, $removed, $updated, $created);
      $this->FromStepRef = $FromStepRef;
      $this->ToStepRef = $ToStepRef;
      $this->UserCanTransition = $UserCanTransition;
    }

    /**
     * @return RecordRef
     */
    public function getFromStepRef()
    {
      return $this->FromStepRef;
    }

    /**
     * @param RecordRef $FromStepRef
     * @return \ProgressionWebService\WorkflowTransition
     */
    public function setFromStepRef($FromStepRef)
    {
      $this->FromStepRef = $FromStepRef;
      return $this;
    }

    /**
     * @return RecordRef
     */
    public function getToStepRef()
    {
      return $this->ToStepRef;
    }

    /**
     * @param RecordRef $ToStepRef
     * @return \ProgressionWebService\WorkflowTransition
     */
    public function setToStepRef($ToStepRef)
    {
      $this->ToStepRef = $ToStepRef;
      return $this;
    }

    /**
     * @return boolean
     */
    public function getUserCanTransition()
    {
      return $this->UserCanTransition;
    }

    /**
     * @param boolean $UserCanTransition
     * @return \ProgressionWebService\WorkflowTransition
     */
    public function setUserCanTransition($UserCanTransition)
    {
      $this->UserCanTransition = $UserCanTransition;
      return $this;
    }

}
