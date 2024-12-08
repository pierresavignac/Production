<?php

namespace ProgressionWebService;

class ReportParam extends Record
{

    /**
     * @var ArrayOfRecord $Options
     */
    protected $Options = null;

    /**
     * @var PropertyOptionsList $OptionsList
     */
    protected $OptionsList = null;

    /**
     * @var string $Label
     */
    protected $Label = null;

    /**
     * @var string $Name
     */
    protected $Name = null;

    /**
     * @var string $Widget
     */
    protected $Widget = null;

    /**
     * @var string $EntityName
     */
    protected $EntityName = null;

    /**
     * @var boolean $Mandatory
     */
    protected $Mandatory = null;

    /**
     * @param int $Id
     * @param string $UID
     * @param string $ExternalId
     * @param \DateTime $removed
     * @param anySimpleType $updated
     * @param anySimpleType $created
     * @param string $Label
     * @param string $Name
     * @param string $Widget
     * @param string $EntityName
     * @param boolean $Mandatory
     */
    public function __construct($Id = null, $UID = null, $ExternalId = null, \DateTime $removed = null, $updated = null, $created = null, $Label = null, $Name = null, $Widget = null, $EntityName = null, $Mandatory = null)
    {
      parent::__construct($Id, $UID, $ExternalId, $removed, $updated, $created);
      $this->Label = $Label;
      $this->Name = $Name;
      $this->Widget = $Widget;
      $this->EntityName = $EntityName;
      $this->Mandatory = $Mandatory;
    }

    /**
     * @return ArrayOfRecord
     */
    public function getOptions()
    {
      return $this->Options;
    }

    /**
     * @param ArrayOfRecord $Options
     * @return \ProgressionWebService\ReportParam
     */
    public function setOptions($Options)
    {
      $this->Options = $Options;
      return $this;
    }

    /**
     * @return PropertyOptionsList
     */
    public function getOptionsList()
    {
      return $this->OptionsList;
    }

    /**
     * @param PropertyOptionsList $OptionsList
     * @return \ProgressionWebService\ReportParam
     */
    public function setOptionsList($OptionsList)
    {
      $this->OptionsList = $OptionsList;
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
     * @return \ProgressionWebService\ReportParam
     */
    public function setLabel($Label)
    {
      $this->Label = $Label;
      return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
      return $this->Name;
    }

    /**
     * @param string $Name
     * @return \ProgressionWebService\ReportParam
     */
    public function setName($Name)
    {
      $this->Name = $Name;
      return $this;
    }

    /**
     * @return string
     */
    public function getWidget()
    {
      return $this->Widget;
    }

    /**
     * @param string $Widget
     * @return \ProgressionWebService\ReportParam
     */
    public function setWidget($Widget)
    {
      $this->Widget = $Widget;
      return $this;
    }

    /**
     * @return string
     */
    public function getEntityName()
    {
      return $this->EntityName;
    }

    /**
     * @param string $EntityName
     * @return \ProgressionWebService\ReportParam
     */
    public function setEntityName($EntityName)
    {
      $this->EntityName = $EntityName;
      return $this;
    }

    /**
     * @return boolean
     */
    public function getMandatory()
    {
      return $this->Mandatory;
    }

    /**
     * @param boolean $Mandatory
     * @return \ProgressionWebService\ReportParam
     */
    public function setMandatory($Mandatory)
    {
      $this->Mandatory = $Mandatory;
      return $this;
    }

}
