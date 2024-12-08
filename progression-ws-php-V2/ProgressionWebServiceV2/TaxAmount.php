<?php

namespace ProgressionWebService;

class TaxAmount extends Record
{

    /**
     * @var RecordRef $TaxRef
     */
    protected $TaxRef = null;

    /**
     * @var float $Amount
     */
    protected $Amount = null;

    /**
     * @param int $Id
     * @param string $UID
     * @param string $ExternalId
     * @param \DateTime $removed
     * @param anySimpleType $updated
     * @param anySimpleType $created
     * @param RecordRef $TaxRef
     * @param float $Amount
     */
    public function __construct($Id = null, $UID = null, $ExternalId = null, \DateTime $removed = null, $updated = null, $created = null, $TaxRef = null, $Amount = null)
    {
      parent::__construct($Id, $UID, $ExternalId, $removed, $updated, $created);
      $this->TaxRef = $TaxRef;
      $this->Amount = $Amount;
    }

    /**
     * @return RecordRef
     */
    public function getTaxRef()
    {
      return $this->TaxRef;
    }

    /**
     * @param RecordRef $TaxRef
     * @return \ProgressionWebService\TaxAmount
     */
    public function setTaxRef($TaxRef)
    {
      $this->TaxRef = $TaxRef;
      return $this;
    }

    /**
     * @return float
     */
    public function getAmount()
    {
      return $this->Amount;
    }

    /**
     * @param float $Amount
     * @return \ProgressionWebService\TaxAmount
     */
    public function setAmount($Amount)
    {
      $this->Amount = $Amount;
      return $this;
    }

}
