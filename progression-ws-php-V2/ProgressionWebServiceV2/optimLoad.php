<?php

namespace ProgressionWebService;

class optimLoad extends Record
{

    /**
     * @var RecordRef $OptimLoadDimensionRef
     */
    protected $OptimLoadDimensionRef = null;

    /**
     * @var float $Quantity
     */
    protected $Quantity = null;

    /**
     * @param int $Id
     * @param string $UID
     * @param string $ExternalId
     * @param \DateTime $removed
     * @param anySimpleType $updated
     * @param anySimpleType $created
     * @param float $Quantity
     */
    public function __construct($Id = null, $UID = null, $ExternalId = null, \DateTime $removed = null, $updated = null, $created = null, $Quantity = null)
    {
      parent::__construct($Id, $UID, $ExternalId, $removed, $updated, $created);
      $this->Quantity = $Quantity;
    }

    /**
     * @return RecordRef
     */
    public function getOptimLoadDimensionRef()
    {
      return $this->OptimLoadDimensionRef;
    }

    /**
     * @param RecordRef $OptimLoadDimensionRef
     * @return \ProgressionWebService\optimLoad
     */
    public function setOptimLoadDimensionRef($OptimLoadDimensionRef)
    {
      $this->OptimLoadDimensionRef = $OptimLoadDimensionRef;
      return $this;
    }

    /**
     * @return float
     */
    public function getQuantity()
    {
      return $this->Quantity;
    }

    /**
     * @param float $Quantity
     * @return \ProgressionWebService\optimLoad
     */
    public function setQuantity($Quantity)
    {
      $this->Quantity = $Quantity;
      return $this;
    }

}
