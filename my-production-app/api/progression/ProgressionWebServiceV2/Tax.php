<?php

namespace ProgressionWebService;

class Tax extends Record
{

    /**
     * @var string $Label
     */
    protected $Label = null;

    /**
     * @var float $Percent
     */
    protected $Percent = null;

    /**
     * @var boolean $Taxable
     */
    protected $Taxable = null;

    /**
     * @var string $TaxNumber
     */
    protected $TaxNumber = null;

    /**
     * @param int $Id
     * @param string $UID
     * @param string $ExternalId
     * @param \DateTime $removed
     * @param anySimpleType $updated
     * @param anySimpleType $created
     * @param string $Label
     * @param float $Percent
     * @param boolean $Taxable
     * @param string $TaxNumber
     */
    public function __construct($Id = null, $UID = null, $ExternalId = null, \DateTime $removed = null, $updated = null, $created = null, $Label = null, $Percent = null, $Taxable = null, $TaxNumber = null)
    {
      parent::__construct($Id, $UID, $ExternalId, $removed, $updated, $created);
      $this->Label = $Label;
      $this->Percent = $Percent;
      $this->Taxable = $Taxable;
      $this->TaxNumber = $TaxNumber;
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
     * @return \ProgressionWebService\Tax
     */
    public function setLabel($Label)
    {
      $this->Label = $Label;
      return $this;
    }

    /**
     * @return float
     */
    public function getPercent()
    {
      return $this->Percent;
    }

    /**
     * @param float $Percent
     * @return \ProgressionWebService\Tax
     */
    public function setPercent($Percent)
    {
      $this->Percent = $Percent;
      return $this;
    }

    /**
     * @return boolean
     */
    public function getTaxable()
    {
      return $this->Taxable;
    }

    /**
     * @param boolean $Taxable
     * @return \ProgressionWebService\Tax
     */
    public function setTaxable($Taxable)
    {
      $this->Taxable = $Taxable;
      return $this;
    }

    /**
     * @return string
     */
    public function getTaxNumber()
    {
      return $this->TaxNumber;
    }

    /**
     * @param string $TaxNumber
     * @return \ProgressionWebService\Tax
     */
    public function setTaxNumber($TaxNumber)
    {
      $this->TaxNumber = $TaxNumber;
      return $this;
    }

}
