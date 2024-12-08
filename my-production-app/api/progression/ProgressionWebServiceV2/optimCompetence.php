<?php

namespace ProgressionWebService;

class optimCompetence extends Record
{

    /**
     * @var string $Name
     */
    protected $Name = null;

    /**
     * @var float $Penalty
     */
    protected $Penalty = null;

    /**
     * @param int $Id
     * @param string $UID
     * @param string $ExternalId
     * @param \DateTime $removed
     * @param anySimpleType $updated
     * @param anySimpleType $created
     * @param string $Name
     * @param float $Penalty
     */
    public function __construct($Id = null, $UID = null, $ExternalId = null, \DateTime $removed = null, $updated = null, $created = null, $Name = null, $Penalty = null)
    {
      parent::__construct($Id, $UID, $ExternalId, $removed, $updated, $created);
      $this->Name = $Name;
      $this->Penalty = $Penalty;
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
     * @return \ProgressionWebService\optimCompetence
     */
    public function setName($Name)
    {
      $this->Name = $Name;
      return $this;
    }

    /**
     * @return float
     */
    public function getPenalty()
    {
      return $this->Penalty;
    }

    /**
     * @param float $Penalty
     * @return \ProgressionWebService\optimCompetence
     */
    public function setPenalty($Penalty)
    {
      $this->Penalty = $Penalty;
      return $this;
    }

}
