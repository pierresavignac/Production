<?php

namespace ProgressionWebService;

class HumanResourceLocation extends Record
{

    /**
     * @var RecordRef $HumanResourceRef
     */
    protected $HumanResourceRef = null;

    /**
     * @var RecordRef $UserRef
     */
    protected $UserRef = null;

    /**
     * @var RecordRef $TaskRef
     */
    protected $TaskRef = null;

    /**
     * @var Location $Location
     */
    protected $Location = null;

    /**
     * @var boolean $Useless
     */
    protected $Useless = null;

    /**
     * @param int $Id
     * @param string $UID
     * @param string $ExternalId
     * @param \DateTime $removed
     * @param anySimpleType $updated
     * @param anySimpleType $created
     * @param boolean $Useless
     */
    public function __construct($Id = null, $UID = null, $ExternalId = null, \DateTime $removed = null, $updated = null, $created = null, $Useless = null)
    {
      parent::__construct($Id, $UID, $ExternalId, $removed, $updated, $created);
      $this->Useless = $Useless;
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
     * @return \ProgressionWebService\HumanResourceLocation
     */
    public function setHumanResourceRef($HumanResourceRef)
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
     * @return \ProgressionWebService\HumanResourceLocation
     */
    public function setUserRef($UserRef)
    {
      $this->UserRef = $UserRef;
      return $this;
    }

    /**
     * @return RecordRef
     */
    public function getTaskRef()
    {
      return $this->TaskRef;
    }

    /**
     * @param RecordRef $TaskRef
     * @return \ProgressionWebService\HumanResourceLocation
     */
    public function setTaskRef($TaskRef)
    {
      $this->TaskRef = $TaskRef;
      return $this;
    }

    /**
     * @return Location
     */
    public function getLocation()
    {
      return $this->Location;
    }

    /**
     * @param Location $Location
     * @return \ProgressionWebService\HumanResourceLocation
     */
    public function setLocation($Location)
    {
      $this->Location = $Location;
      return $this;
    }

    /**
     * @return boolean
     */
    public function getUseless()
    {
      return $this->Useless;
    }

    /**
     * @param boolean $Useless
     * @return \ProgressionWebService\HumanResourceLocation
     */
    public function setUseless($Useless)
    {
      $this->Useless = $Useless;
      return $this;
    }

}
