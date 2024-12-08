<?php

namespace ProgressionWebService;

class TaskPriority extends Record
{

    /**
     * @var int $Index
     */
    protected $Index = null;

    /**
     * @var string $Label
     */
    protected $Label = null;

    /**
     * @var string $Color
     */
    protected $Color = null;

    /**
     * @var boolean $Alert
     */
    protected $Alert = null;

    /**
     * @param int $Id
     * @param string $UID
     * @param string $ExternalId
     * @param \DateTime $removed
     * @param anySimpleType $updated
     * @param anySimpleType $created
     * @param int $Index
     * @param string $Label
     * @param string $Color
     * @param boolean $Alert
     */
    public function __construct($Id = null, $UID = null, $ExternalId = null, \DateTime $removed = null, $updated = null, $created = null, $Index = null, $Label = null, $Color = null, $Alert = null)
    {
      parent::__construct($Id, $UID, $ExternalId, $removed, $updated, $created);
      $this->Index = $Index;
      $this->Label = $Label;
      $this->Color = $Color;
      $this->Alert = $Alert;
    }

    /**
     * @return int
     */
    public function getIndex()
    {
      return $this->Index;
    }

    /**
     * @param int $Index
     * @return \ProgressionWebService\TaskPriority
     */
    public function setIndex($Index)
    {
      $this->Index = $Index;
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
     * @return \ProgressionWebService\TaskPriority
     */
    public function setLabel($Label)
    {
      $this->Label = $Label;
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
     * @return \ProgressionWebService\TaskPriority
     */
    public function setColor($Color)
    {
      $this->Color = $Color;
      return $this;
    }

    /**
     * @return boolean
     */
    public function getAlert()
    {
      return $this->Alert;
    }

    /**
     * @param boolean $Alert
     * @return \ProgressionWebService\TaskPriority
     */
    public function setAlert($Alert)
    {
      $this->Alert = $Alert;
      return $this;
    }

}
