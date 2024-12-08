<?php

namespace ProgressionWebService;

class Workflow extends Record
{

    /**
     * @var ArrayOfRecord $Steps
     */
    protected $Steps = null;

    /**
     * @var RecordRef $StartTransitionRef
     */
    protected $StartTransitionRef = null;

    /**
     * @var string $Label
     */
    protected $Label = null;

    /**
     * @param int $Id
     * @param string $UID
     * @param string $ExternalId
     * @param \DateTime $removed
     * @param anySimpleType $updated
     * @param anySimpleType $created
     * @param RecordRef $StartTransitionRef
     * @param string $Label
     */
    public function __construct($Id = null, $UID = null, $ExternalId = null, \DateTime $removed = null, $updated = null, $created = null, $StartTransitionRef = null, $Label = null)
    {
      parent::__construct($Id, $UID, $ExternalId, $removed, $updated, $created);
      $this->StartTransitionRef = $StartTransitionRef;
      $this->Label = $Label;
    }

    /**
     * @return ArrayOfRecord
     */
    public function getSteps()
    {
      return $this->Steps;
    }

    /**
     * @param ArrayOfRecord $Steps
     * @return \ProgressionWebService\Workflow
     */
    public function setSteps($Steps)
    {
      $this->Steps = $Steps;
      return $this;
    }

    /**
     * @return RecordRef
     */
    public function getStartTransitionRef()
    {
      return $this->StartTransitionRef;
    }

    /**
     * @param RecordRef $StartTransitionRef
     * @return \ProgressionWebService\Workflow
     */
    public function setStartTransitionRef($StartTransitionRef)
    {
      $this->StartTransitionRef = $StartTransitionRef;
      return $this;
    }

    /**
     * @return string
     */
    public function getLabel()
    {
      return $this->Label;
    }

    /**
     * @param string $Label
     * @return \ProgressionWebService\Workflow
     */
    public function setLabel($Label)
    {
      $this->Label = $Label;
      return $this;
    }

}
