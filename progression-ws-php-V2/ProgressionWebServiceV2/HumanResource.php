<?php

namespace ProgressionWebService;

class HumanResource extends Resource
{

    /**
     * @var RecordRef $DisponibilityRef
     */
    protected $DisponibilityRef = null;

    /**
     * @var ArrayOfRecordRef $ResourcesRef
     */
    protected $ResourcesRef = null;

    /**
     * @var HumanResourceOptim $Optim
     */
    protected $Optim = null;

    /**
     * @param int $Id
     * @param string $UID
     * @param string $ExternalId
     * @param \DateTime $removed
     * @param anySimpleType $updated
     * @param anySimpleType $created
     * @param RecordRef $TypeRef
     * @param RecordRef $ClientRef
     * @param RecordRef $NodeRef
     * @param string $Label
     */
    public function __construct($Id = null, $UID = null, $ExternalId = null, \DateTime $removed = null, $updated = null, $created = null, $TypeRef = null, $ClientRef = null, $NodeRef = null, $Label = null)
    {
      parent::__construct($Id, $UID, $ExternalId, $removed, $updated, $created, $TypeRef, $ClientRef, $NodeRef, $Label);
    }

    /**
     * @return RecordRef
     */
    public function getDisponibilityRef()
    {
      return $this->DisponibilityRef;
    }

    /**
     * @param RecordRef $DisponibilityRef
     * @return \ProgressionWebService\HumanResource
     */
    public function setDisponibilityRef($DisponibilityRef)
    {
      $this->DisponibilityRef = $DisponibilityRef;
      return $this;
    }

    /**
     * @return ArrayOfRecordRef
     */
    public function getResourcesRef()
    {
      return $this->ResourcesRef;
    }

    /**
     * @param ArrayOfRecordRef $ResourcesRef
     * @return \ProgressionWebService\HumanResource
     */
    public function setResourcesRef($ResourcesRef)
    {
      $this->ResourcesRef = $ResourcesRef;
      return $this;
    }

    /**
     * @return HumanResourceOptim
     */
    public function getOptim()
    {
      return $this->Optim;
    }

    /**
     * @param HumanResourceOptim $Optim
     * @return \ProgressionWebService\HumanResource
     */
    public function setOptim($Optim)
    {
      $this->Optim = $Optim;
      return $this;
    }

}
