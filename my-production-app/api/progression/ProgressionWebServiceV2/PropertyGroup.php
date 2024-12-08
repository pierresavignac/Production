<?php

namespace ProgressionWebService;

class PropertyGroup extends Record
{

    /**
     * @var ArrayOfRecord $PropertyDefinitions
     */
    protected $PropertyDefinitions = null;

    /**
     * @var string $Label
     */
    protected $Label = null;

    /**
     * @var string $Name
     */
    protected $Name = null;

    /**
     * @var string $EntityName
     */
    protected $EntityName = null;

    /**
     * @var int $EntityTypeId
     */
    protected $EntityTypeId = null;

    /**
     * @var string $EntityPropGroupName
     */
    protected $EntityPropGroupName = null;

    /**
     * @var Visibility $Visibility
     */
    protected $Visibility = null;

    /**
     * @var boolean $entityReadOnly
     */
    protected $entityReadOnly = null;

    /**
     * @param int $Id
     * @param string $UID
     * @param string $ExternalId
     * @param \DateTime $removed
     * @param anySimpleType $updated
     * @param anySimpleType $created
     * @param string $Label
     * @param string $Name
     * @param string $EntityName
     * @param int $EntityTypeId
     * @param string $EntityPropGroupName
     * @param Visibility $Visibility
     * @param boolean $entityReadOnly
     */
    public function __construct($Id = null, $UID = null, $ExternalId = null, \DateTime $removed = null, $updated = null, $created = null, $Label = null, $Name = null, $EntityName = null, $EntityTypeId = null, $EntityPropGroupName = null, $Visibility = null, $entityReadOnly = null)
    {
      parent::__construct($Id, $UID, $ExternalId, $removed, $updated, $created);
      $this->Label = $Label;
      $this->Name = $Name;
      $this->EntityName = $EntityName;
      $this->EntityTypeId = $EntityTypeId;
      $this->EntityPropGroupName = $EntityPropGroupName;
      $this->Visibility = $Visibility;
      $this->entityReadOnly = $entityReadOnly;
    }

    /**
     * @return ArrayOfRecord
     */
    public function getPropertyDefinitions()
    {
      return $this->PropertyDefinitions;
    }

    /**
     * @param ArrayOfRecord $PropertyDefinitions
     * @return \ProgressionWebService\PropertyGroup
     */
    public function setPropertyDefinitions($PropertyDefinitions)
    {
      $this->PropertyDefinitions = $PropertyDefinitions;
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
     * @return \ProgressionWebService\PropertyGroup
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
     * @return \ProgressionWebService\PropertyGroup
     */
    public function setName($Name)
    {
      $this->Name = $Name;
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
     * @return \ProgressionWebService\PropertyGroup
     */
    public function setEntityName($EntityName)
    {
      $this->EntityName = $EntityName;
      return $this;
    }

    /**
     * @return int
     */
    public function getEntityTypeId()
    {
      return $this->EntityTypeId;
    }

    /**
     * @param int $EntityTypeId
     * @return \ProgressionWebService\PropertyGroup
     */
    public function setEntityTypeId($EntityTypeId)
    {
      $this->EntityTypeId = $EntityTypeId;
      return $this;
    }

    /**
     * @return string
     */
    public function getEntityPropGroupName()
    {
      return $this->EntityPropGroupName;
    }

    /**
     * @param string $EntityPropGroupName
     * @return \ProgressionWebService\PropertyGroup
     */
    public function setEntityPropGroupName($EntityPropGroupName)
    {
      $this->EntityPropGroupName = $EntityPropGroupName;
      return $this;
    }

    /**
     * @return Visibility
     */
    public function getVisibility()
    {
      return $this->Visibility;
    }

    /**
     * @param Visibility $Visibility
     * @return \ProgressionWebService\PropertyGroup
     */
    public function setVisibility($Visibility)
    {
      $this->Visibility = $Visibility;
      return $this;
    }

    /**
     * @return boolean
     */
    public function getEntityReadOnly()
    {
      return $this->entityReadOnly;
    }

    /**
     * @param boolean $entityReadOnly
     * @return \ProgressionWebService\PropertyGroup
     */
    public function setEntityReadOnly($entityReadOnly)
    {
      $this->entityReadOnly = $entityReadOnly;
      return $this;
    }

}
