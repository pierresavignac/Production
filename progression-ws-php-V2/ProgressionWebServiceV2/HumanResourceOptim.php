<?php

namespace ProgressionWebService;

class HumanResourceOptim extends Record
{

    /**
     * @var Address $StartAddress
     */
    protected $StartAddress = null;

    /**
     * @var Address $EndAddress
     */
    protected $EndAddress = null;

    /**
     * @var ArrayOfRecordRef $Competences
     */
    protected $Competences = null;

    /**
     * @var ArrayOfRecord $Capacities
     */
    protected $Capacities = null;

    /**
     * @var string $Color
     */
    protected $Color = null;

    /**
     * @var boolean $ReturnToDepot
     */
    protected $ReturnToDepot = null;

    /**
     * @var boolean $StartAddressSameAsAddress
     */
    protected $StartAddressSameAsAddress = null;

    /**
     * @var boolean $EndAddressSameAsAddress
     */
    protected $EndAddressSameAsAddress = null;

    /**
     * @var float $ServiceTimeFactor
     */
    protected $ServiceTimeFactor = null;

    /**
     * @var int $MaxVelocityInKm
     */
    protected $MaxVelocityInKm = null;

    /**
     * @var float $CostPerDay
     */
    protected $CostPerDay = null;

    /**
     * @var float $CostPerKm
     */
    protected $CostPerKm = null;

    /**
     * @var float $CostPerHour
     */
    protected $CostPerHour = null;

    /**
     * @param int $Id
     * @param string $UID
     * @param string $ExternalId
     * @param \DateTime $removed
     * @param anySimpleType $updated
     * @param anySimpleType $created
     * @param string $Color
     * @param boolean $ReturnToDepot
     * @param boolean $StartAddressSameAsAddress
     * @param boolean $EndAddressSameAsAddress
     * @param float $ServiceTimeFactor
     * @param int $MaxVelocityInKm
     * @param float $CostPerDay
     * @param float $CostPerKm
     * @param float $CostPerHour
     */
    public function __construct($Id = null, $UID = null, $ExternalId = null, \DateTime $removed = null, $updated = null, $created = null, $Color = null, $ReturnToDepot = null, $StartAddressSameAsAddress = null, $EndAddressSameAsAddress = null, $ServiceTimeFactor = null, $MaxVelocityInKm = null, $CostPerDay = null, $CostPerKm = null, $CostPerHour = null)
    {
      parent::__construct($Id, $UID, $ExternalId, $removed, $updated, $created);
      $this->Color = $Color;
      $this->ReturnToDepot = $ReturnToDepot;
      $this->StartAddressSameAsAddress = $StartAddressSameAsAddress;
      $this->EndAddressSameAsAddress = $EndAddressSameAsAddress;
      $this->ServiceTimeFactor = $ServiceTimeFactor;
      $this->MaxVelocityInKm = $MaxVelocityInKm;
      $this->CostPerDay = $CostPerDay;
      $this->CostPerKm = $CostPerKm;
      $this->CostPerHour = $CostPerHour;
    }

    /**
     * @return Address
     */
    public function getStartAddress()
    {
      return $this->StartAddress;
    }

    /**
     * @param Address $StartAddress
     * @return \ProgressionWebService\HumanResourceOptim
     */
    public function setStartAddress($StartAddress)
    {
      $this->StartAddress = $StartAddress;
      return $this;
    }

    /**
     * @return Address
     */
    public function getEndAddress()
    {
      return $this->EndAddress;
    }

    /**
     * @param Address $EndAddress
     * @return \ProgressionWebService\HumanResourceOptim
     */
    public function setEndAddress($EndAddress)
    {
      $this->EndAddress = $EndAddress;
      return $this;
    }

    /**
     * @return ArrayOfRecordRef
     */
    public function getCompetences()
    {
      return $this->Competences;
    }

    /**
     * @param ArrayOfRecordRef $Competences
     * @return \ProgressionWebService\HumanResourceOptim
     */
    public function setCompetences($Competences)
    {
      $this->Competences = $Competences;
      return $this;
    }

    /**
     * @return ArrayOfRecord
     */
    public function getCapacities()
    {
      return $this->Capacities;
    }

    /**
     * @param ArrayOfRecord $Capacities
     * @return \ProgressionWebService\HumanResourceOptim
     */
    public function setCapacities($Capacities)
    {
      $this->Capacities = $Capacities;
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
     * @return \ProgressionWebService\HumanResourceOptim
     */
    public function setColor($Color)
    {
      $this->Color = $Color;
      return $this;
    }

    /**
     * @return boolean
     */
    public function getReturnToDepot()
    {
      return $this->ReturnToDepot;
    }

    /**
     * @param boolean $ReturnToDepot
     * @return \ProgressionWebService\HumanResourceOptim
     */
    public function setReturnToDepot($ReturnToDepot)
    {
      $this->ReturnToDepot = $ReturnToDepot;
      return $this;
    }

    /**
     * @return boolean
     */
    public function getStartAddressSameAsAddress()
    {
      return $this->StartAddressSameAsAddress;
    }

    /**
     * @param boolean $StartAddressSameAsAddress
     * @return \ProgressionWebService\HumanResourceOptim
     */
    public function setStartAddressSameAsAddress($StartAddressSameAsAddress)
    {
      $this->StartAddressSameAsAddress = $StartAddressSameAsAddress;
      return $this;
    }

    /**
     * @return boolean
     */
    public function getEndAddressSameAsAddress()
    {
      return $this->EndAddressSameAsAddress;
    }

    /**
     * @param boolean $EndAddressSameAsAddress
     * @return \ProgressionWebService\HumanResourceOptim
     */
    public function setEndAddressSameAsAddress($EndAddressSameAsAddress)
    {
      $this->EndAddressSameAsAddress = $EndAddressSameAsAddress;
      return $this;
    }

    /**
     * @return float
     */
    public function getServiceTimeFactor()
    {
      return $this->ServiceTimeFactor;
    }

    /**
     * @param float $ServiceTimeFactor
     * @return \ProgressionWebService\HumanResourceOptim
     */
    public function setServiceTimeFactor($ServiceTimeFactor)
    {
      $this->ServiceTimeFactor = $ServiceTimeFactor;
      return $this;
    }

    /**
     * @return int
     */
    public function getMaxVelocityInKm()
    {
      return $this->MaxVelocityInKm;
    }

    /**
     * @param int $MaxVelocityInKm
     * @return \ProgressionWebService\HumanResourceOptim
     */
    public function setMaxVelocityInKm($MaxVelocityInKm)
    {
      $this->MaxVelocityInKm = $MaxVelocityInKm;
      return $this;
    }

    /**
     * @return float
     */
    public function getCostPerDay()
    {
      return $this->CostPerDay;
    }

    /**
     * @param float $CostPerDay
     * @return \ProgressionWebService\HumanResourceOptim
     */
    public function setCostPerDay($CostPerDay)
    {
      $this->CostPerDay = $CostPerDay;
      return $this;
    }

    /**
     * @return float
     */
    public function getCostPerKm()
    {
      return $this->CostPerKm;
    }

    /**
     * @param float $CostPerKm
     * @return \ProgressionWebService\HumanResourceOptim
     */
    public function setCostPerKm($CostPerKm)
    {
      $this->CostPerKm = $CostPerKm;
      return $this;
    }

    /**
     * @return float
     */
    public function getCostPerHour()
    {
      return $this->CostPerHour;
    }

    /**
     * @param float $CostPerHour
     * @return \ProgressionWebService\HumanResourceOptim
     */
    public function setCostPerHour($CostPerHour)
    {
      $this->CostPerHour = $CostPerHour;
      return $this;
    }

}
