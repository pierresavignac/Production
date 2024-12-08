<?php

namespace ProgressionWebService;

class TaskOptim extends Record
{

    /**
     * @var OptimTimeWindow $TimeWindow
     */
    protected $TimeWindow = null;

    /**
     * @var OptimLoadType $LoadType
     */
    protected $LoadType = null;

    /**
     * @var ArrayOfRecordRef $OptimCompetenceRefs
     */
    protected $OptimCompetenceRefs = null;

    /**
     * @var ArrayOfRecord $Loads
     */
    protected $Loads = null;

    /**
     * @var OptimResult $Result
     */
    protected $Result = null;

    /**
     * @var boolean $FixedHumanResource
     */
    protected $FixedHumanResource = null;

    /**
     * @var boolean $FixedAppointment
     */
    protected $FixedAppointment = null;

    /**
     * @var float $NoVisitPenalty
     */
    protected $NoVisitPenalty = null;

    /**
     * @param int $Id
     * @param string $UID
     * @param string $ExternalId
     * @param \DateTime $removed
     * @param anySimpleType $updated
     * @param anySimpleType $created
     * @param boolean $FixedHumanResource
     * @param boolean $FixedAppointment
     * @param float $NoVisitPenalty
     */
    public function __construct($Id = null, $UID = null, $ExternalId = null, \DateTime $removed = null, $updated = null, $created = null, $FixedHumanResource = null, $FixedAppointment = null, $NoVisitPenalty = null)
    {
      parent::__construct($Id, $UID, $ExternalId, $removed, $updated, $created);
      $this->FixedHumanResource = $FixedHumanResource;
      $this->FixedAppointment = $FixedAppointment;
      $this->NoVisitPenalty = $NoVisitPenalty;
    }

    /**
     * @return OptimTimeWindow
     */
    public function getTimeWindow()
    {
      return $this->TimeWindow;
    }

    /**
     * @param OptimTimeWindow $TimeWindow
     * @return \ProgressionWebService\TaskOptim
     */
    public function setTimeWindow($TimeWindow)
    {
      $this->TimeWindow = $TimeWindow;
      return $this;
    }

    /**
     * @return OptimLoadType
     */
    public function getLoadType()
    {
      return $this->LoadType;
    }

    /**
     * @param OptimLoadType $LoadType
     * @return \ProgressionWebService\TaskOptim
     */
    public function setLoadType($LoadType)
    {
      $this->LoadType = $LoadType;
      return $this;
    }

    /**
     * @return ArrayOfRecordRef
     */
    public function getOptimCompetenceRefs()
    {
      return $this->OptimCompetenceRefs;
    }

    /**
     * @param ArrayOfRecordRef $OptimCompetenceRefs
     * @return \ProgressionWebService\TaskOptim
     */
    public function setOptimCompetenceRefs($OptimCompetenceRefs)
    {
      $this->OptimCompetenceRefs = $OptimCompetenceRefs;
      return $this;
    }

    /**
     * @return ArrayOfRecord
     */
    public function getLoads()
    {
      return $this->Loads;
    }

    /**
     * @param ArrayOfRecord $Loads
     * @return \ProgressionWebService\TaskOptim
     */
    public function setLoads($Loads)
    {
      $this->Loads = $Loads;
      return $this;
    }

    /**
     * @return OptimResult
     */
    public function getResult()
    {
      return $this->Result;
    }

    /**
     * @param OptimResult $Result
     * @return \ProgressionWebService\TaskOptim
     */
    public function setResult($Result)
    {
      $this->Result = $Result;
      return $this;
    }

    /**
     * @return boolean
     */
    public function getFixedHumanResource()
    {
      return $this->FixedHumanResource;
    }

    /**
     * @param boolean $FixedHumanResource
     * @return \ProgressionWebService\TaskOptim
     */
    public function setFixedHumanResource($FixedHumanResource)
    {
      $this->FixedHumanResource = $FixedHumanResource;
      return $this;
    }

    /**
     * @return boolean
     */
    public function getFixedAppointment()
    {
      return $this->FixedAppointment;
    }

    /**
     * @param boolean $FixedAppointment
     * @return \ProgressionWebService\TaskOptim
     */
    public function setFixedAppointment($FixedAppointment)
    {
      $this->FixedAppointment = $FixedAppointment;
      return $this;
    }

    /**
     * @return float
     */
    public function getNoVisitPenalty()
    {
      return $this->NoVisitPenalty;
    }

    /**
     * @param float $NoVisitPenalty
     * @return \ProgressionWebService\TaskOptim
     */
    public function setNoVisitPenalty($NoVisitPenalty)
    {
      $this->NoVisitPenalty = $NoVisitPenalty;
      return $this;
    }

}
