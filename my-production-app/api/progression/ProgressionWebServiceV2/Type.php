<?php

namespace ProgressionWebService;

abstract class Type extends Record
{

    /**
     * @var ArrayOfRecord $PropertyGroups
     */
    protected $PropertyGroups = null;

    /**
     * @var ArrayOfProperty $ContextPropertyConfigurations
     */
    protected $ContextPropertyConfigurations = null;

    /**
     * @var string $Label
     */
    protected $Label = null;

    /**
     * @var boolean $mobileAllowCreate
     */
    protected $mobileAllowCreate = null;

    /**
     * @var boolean $defaultType
     */
    protected $defaultType = null;

    /**
     * @var boolean $allowCreate
     */
    protected $allowCreate = null;

    /**
     * @param int $Id
     * @param string $UID
     * @param string $ExternalId
     * @param \DateTime $removed
     * @param anySimpleType $updated
     * @param anySimpleType $created
     * @param string $Label
     * @param boolean $mobileAllowCreate
     * @param boolean $defaultType
     * @param boolean $allowCreate
     */
    public function __construct($Id = null, $UID = null, $ExternalId = null, \DateTime $removed = null, $updated = null, $created = null, $Label = null, $mobileAllowCreate = null, $defaultType = null, $allowCreate = null)
    {
      parent::__construct($Id, $UID, $ExternalId, $removed, $updated, $created);
      $this->Label = $Label;
      $this->mobileAllowCreate = $mobileAllowCreate;
      $this->defaultType = $defaultType;
      $this->allowCreate = $allowCreate;
    }

    /**
     * @return ArrayOfRecord
     */
    public function getPropertyGroups()
    {
      return $this->PropertyGroups;
    }

    /**
     * @param ArrayOfRecord $PropertyGroups
     * @return \ProgressionWebService\Type
     */
    public function setPropertyGroups($PropertyGroups)
    {
      $this->PropertyGroups = $PropertyGroups;
      return $this;
    }

    /**
     * @return ArrayOfProperty
     */
    public function getContextPropertyConfigurations()
    {
      return $this->ContextPropertyConfigurations;
    }

    /**
     * @param ArrayOfProperty $ContextPropertyConfigurations
     * @return \ProgressionWebService\Type
     */
    public function setContextPropertyConfigurations($ContextPropertyConfigurations)
    {
      $this->ContextPropertyConfigurations = $ContextPropertyConfigurations;
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
     * @return \ProgressionWebService\Type
     */
    public function setLabel($Label)
    {
      $this->Label = $Label;
      return $this;
    }

    /**
     * @return boolean
     */
    public function getMobileAllowCreate()
    {
      return $this->mobileAllowCreate;
    }

    /**
     * @param boolean $mobileAllowCreate
     * @return \ProgressionWebService\Type
     */
    public function setMobileAllowCreate($mobileAllowCreate)
    {
      $this->mobileAllowCreate = $mobileAllowCreate;
      return $this;
    }

    /**
     * @return boolean
     */
    public function getDefaultType()
    {
      return $this->defaultType;
    }

    /**
     * @param boolean $defaultType
     * @return \ProgressionWebService\Type
     */
    public function setDefaultType($defaultType)
    {
      $this->defaultType = $defaultType;
      return $this;
    }

    /**
     * @return boolean
     */
    public function getAllowCreate()
    {
      return $this->allowCreate;
    }

    /**
     * @param boolean $allowCreate
     * @return \ProgressionWebService\Type
     */
    public function setAllowCreate($allowCreate)
    {
      $this->allowCreate = $allowCreate;
      return $this;
    }

}
