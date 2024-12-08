<?php

namespace ProgressionWebService;

class PropertyDefinition extends Record
{

    /**
     * @var RecordRef $OptionsListRef
     */
    protected $OptionsListRef = null;

    /**
     * @var int $Index
     */
    protected $Index = null;

    /**
     * @var string $Name
     */
    protected $Name = null;

    /**
     * @var string $Label
     */
    protected $Label = null;

    /**
     * @var string $Widget
     */
    protected $Widget = null;

    /**
     * @var string $Classes
     */
    protected $Classes = null;

    /**
     * @var boolean $Historable
     */
    protected $Historable = null;

    /**
     * @var Visibility $Visibility
     */
    protected $Visibility = null;

    /**
     * @param int $Id
     * @param string $UID
     * @param string $ExternalId
     * @param \DateTime $removed
     * @param anySimpleType $updated
     * @param anySimpleType $created
     * @param int $Index
     * @param string $Name
     * @param string $Label
     * @param string $Widget
     * @param string $Classes
     * @param boolean $Historable
     * @param Visibility $Visibility
     */
    public function __construct($Id = null, $UID = null, $ExternalId = null, \DateTime $removed = null, $updated = null, $created = null, $Index = null, $Name = null, $Label = null, $Widget = null, $Classes = null, $Historable = null, $Visibility = null)
    {
      parent::__construct($Id, $UID, $ExternalId, $removed, $updated, $created);
      $this->Index = $Index;
      $this->Name = $Name;
      $this->Label = $Label;
      $this->Widget = $Widget;
      $this->Classes = $Classes;
      $this->Historable = $Historable;
      $this->Visibility = $Visibility;
    }

    /**
     * @return RecordRef
     */
    public function getOptionsListRef()
    {
      return $this->OptionsListRef;
    }

    /**
     * @param RecordRef $OptionsListRef
     * @return \ProgressionWebService\PropertyDefinition
     */
    public function setOptionsListRef($OptionsListRef)
    {
      $this->OptionsListRef = $OptionsListRef;
      return $this;
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
     * @return \ProgressionWebService\PropertyDefinition
     */
    public function setIndex($Index)
    {
      $this->Index = $Index;
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
     * @return \ProgressionWebService\PropertyDefinition
     */
    public function setName($Name)
    {
      $this->Name = $Name;
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
     * @return \ProgressionWebService\PropertyDefinition
     */
    public function setLabel($Label)
    {
      $this->Label = $Label;
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
     * @return \ProgressionWebService\PropertyDefinition
     */
    public function setWidget($Widget)
    {
      $this->Widget = $Widget;
      return $this;
    }

    /**
     * @return string
     */
    public function getClasses()
    {
      return $this->Classes;
    }

    /**
     * @param string $Classes
     * @return \ProgressionWebService\PropertyDefinition
     */
    public function setClasses($Classes)
    {
      $this->Classes = $Classes;
      return $this;
    }

    /**
     * @return boolean
     */
    public function getHistorable()
    {
      return $this->Historable;
    }

    /**
     * @param boolean $Historable
     * @return \ProgressionWebService\PropertyDefinition
     */
    public function setHistorable($Historable)
    {
      $this->Historable = $Historable;
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
     * @return \ProgressionWebService\PropertyDefinition
     */
    public function setVisibility($Visibility)
    {
      $this->Visibility = $Visibility;
      return $this;
    }

}
