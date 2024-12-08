<?php

namespace ProgressionWebService;

class ResourceLocation extends Record
{

    /**
     * @var RecordRef $ResourceRef
     */
    protected $ResourceRef = null;

    /**
     * @var RecordRef $UserRef
     */
    protected $UserRef = null;

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
    public function getResourceRef()
    {
      return $this->ResourceRef;
    }

    /**
     * @param RecordRef $ResourceRef
     * @return \ProgressionWebService\ResourceLocation
     */
    public function setResourceRef($ResourceRef)
    {
      $this->ResourceRef = $ResourceRef;
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
     * @return \ProgressionWebService\ResourceLocation
     */
    public function setUserRef($UserRef)
    {
      $this->UserRef = $UserRef;
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
     * @return \ProgressionWebService\ResourceLocation
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
     * @return \ProgressionWebService\ResourceLocation
     */
    public function setUseless($Useless)
    {
      $this->Useless = $Useless;
      return $this;
    }

}
