<?php

namespace ProgressionWebService;

class PropertyConfiguration extends Record
{

    /**
     * @var ArrayOfInt $MandatoryInLogicIds
     */
    protected $MandatoryInLogicIds = null;

    /**
     * @var boolean $Mandatory
     */
    protected $Mandatory = null;

    /**
     * @var string $DefaultValue
     */
    protected $DefaultValue = null;

    /**
     * @var int $DefaultValueEntityId
     */
    protected $DefaultValueEntityId = null;

    /**
     * @var boolean $Visible
     */
    protected $Visible = null;

    /**
     * @param int $Id
     * @param string $UID
     * @param string $ExternalId
     * @param \DateTime $removed
     * @param anySimpleType $updated
     * @param anySimpleType $created
     * @param boolean $Mandatory
     * @param string $DefaultValue
     * @param int $DefaultValueEntityId
     * @param boolean $Visible
     */
    public function __construct($Id = null, $UID = null, $ExternalId = null, \DateTime $removed = null, $updated = null, $created = null, $Mandatory = null, $DefaultValue = null, $DefaultValueEntityId = null, $Visible = null)
    {
      parent::__construct($Id, $UID, $ExternalId, $removed, $updated, $created);
      $this->Mandatory = $Mandatory;
      $this->DefaultValue = $DefaultValue;
      $this->DefaultValueEntityId = $DefaultValueEntityId;
      $this->Visible = $Visible;
    }

    /**
     * @return ArrayOfInt
     */
    public function getMandatoryInLogicIds()
    {
      return $this->MandatoryInLogicIds;
    }

    /**
     * @param ArrayOfInt $MandatoryInLogicIds
     * @return \ProgressionWebService\PropertyConfiguration
     */
    public function setMandatoryInLogicIds($MandatoryInLogicIds)
    {
      $this->MandatoryInLogicIds = $MandatoryInLogicIds;
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
     * @return \ProgressionWebService\PropertyConfiguration
     */
    public function setMandatory($Mandatory)
    {
      $this->Mandatory = $Mandatory;
      return $this;
    }

    /**
     * @return string
     */
    public function getDefaultValue()
    {
      return $this->DefaultValue;
    }

    /**
     * @param string $DefaultValue
     * @return \ProgressionWebService\PropertyConfiguration
     */
    public function setDefaultValue($DefaultValue)
    {
      $this->DefaultValue = $DefaultValue;
      return $this;
    }

    /**
     * @return int
     */
    public function getDefaultValueEntityId()
    {
      return $this->DefaultValueEntityId;
    }

    /**
     * @param int $DefaultValueEntityId
     * @return \ProgressionWebService\PropertyConfiguration
     */
    public function setDefaultValueEntityId($DefaultValueEntityId)
    {
      $this->DefaultValueEntityId = $DefaultValueEntityId;
      return $this;
    }

    /**
     * @return boolean
     */
    public function getVisible()
    {
      return $this->Visible;
    }

    /**
     * @param boolean $Visible
     * @return \ProgressionWebService\PropertyConfiguration
     */
    public function setVisible($Visible)
    {
      $this->Visible = $Visible;
      return $this;
    }

}
