<?php

namespace ProgressionWebService;

class WorkflowStep extends Record
{

    /**
     * @var ArrayOfRecord $Transitions
     */
    protected $Transitions = null;

    /**
     * @var ArrayOfProperty $ActionLabels
     */
    protected $ActionLabels = null;

    /**
     * @var ArrayOfProperty $StatusLabels
     */
    protected $StatusLabels = null;

    /**
     * @var string $ActionLabel
     */
    protected $ActionLabel = null;

    /**
     * @var string $StatusLabel
     */
    protected $StatusLabel = null;

    /**
     * @var int $LogicId
     */
    protected $LogicId = null;

    /**
     * @var string $Color
     */
    protected $Color = null;

    /**
     * @var boolean $Synchronous
     */
    protected $Synchronous = null;

    /**
     * @param int $Id
     * @param string $UID
     * @param string $ExternalId
     * @param \DateTime $removed
     * @param anySimpleType $updated
     * @param anySimpleType $created
     * @param string $ActionLabel
     * @param string $StatusLabel
     * @param int $LogicId
     * @param string $Color
     * @param boolean $Synchronous
     */
    public function __construct($Id = null, $UID = null, $ExternalId = null, \DateTime $removed = null, $updated = null, $created = null, $ActionLabel = null, $StatusLabel = null, $LogicId = null, $Color = null, $Synchronous = null)
    {
      parent::__construct($Id, $UID, $ExternalId, $removed, $updated, $created);
      $this->ActionLabel = $ActionLabel;
      $this->StatusLabel = $StatusLabel;
      $this->LogicId = $LogicId;
      $this->Color = $Color;
      $this->Synchronous = $Synchronous;
    }

    /**
     * @return ArrayOfRecord
     */
    public function getTransitions()
    {
      return $this->Transitions;
    }

    /**
     * @param ArrayOfRecord $Transitions
     * @return \ProgressionWebService\WorkflowStep
     */
    public function setTransitions($Transitions)
    {
      $this->Transitions = $Transitions;
      return $this;
    }

    /**
     * @return ArrayOfProperty
     */
    public function getActionLabels()
    {
      return $this->ActionLabels;
    }

    /**
     * @param ArrayOfProperty $ActionLabels
     * @return \ProgressionWebService\WorkflowStep
     */
    public function setActionLabels($ActionLabels)
    {
      $this->ActionLabels = $ActionLabels;
      return $this;
    }

    /**
     * @return ArrayOfProperty
     */
    public function getStatusLabels()
    {
      return $this->StatusLabels;
    }

    /**
     * @param ArrayOfProperty $StatusLabels
     * @return \ProgressionWebService\WorkflowStep
     */
    public function setStatusLabels($StatusLabels)
    {
      $this->StatusLabels = $StatusLabels;
      return $this;
    }

    /**
     * @return string
     */
    public function getActionLabel()
    {
      return $this->ActionLabel;
    }

    /**
     * @param string $ActionLabel
     * @return \ProgressionWebService\WorkflowStep
     */
    public function setActionLabel($ActionLabel)
    {
      $this->ActionLabel = $ActionLabel;
      return $this;
    }

    /**
     * @return string
     */
    public function getStatusLabel()
    {
      return $this->StatusLabel;
    }

    /**
     * @param string $StatusLabel
     * @return \ProgressionWebService\WorkflowStep
     */
    public function setStatusLabel($StatusLabel)
    {
      $this->StatusLabel = $StatusLabel;
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
     * @return \ProgressionWebService\WorkflowStep
     */
    public function setLogicId($LogicId)
    {
      $this->LogicId = $LogicId;
      return $this;
    }

    /**
     * @return string
     */
    public function getColor()
    {
      return $this->Color;
    }

    /**
     * @param string $Color
     * @return \ProgressionWebService\WorkflowStep
     */
    public function setColor($Color)
    {
      $this->Color = $Color;
      return $this;
    }

    /**
     * @return boolean
     */
    public function getSynchronous()
    {
      return $this->Synchronous;
    }

    /**
     * @param boolean $Synchronous
     * @return \ProgressionWebService\WorkflowStep
     */
    public function setSynchronous($Synchronous)
    {
      $this->Synchronous = $Synchronous;
      return $this;
    }

}
