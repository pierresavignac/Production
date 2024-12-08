<?php

namespace ProgressionWebService;

class TaxConfig extends Record
{

    /**
     * @var ArrayOfRecord $Taxes
     */
    protected $Taxes = null;

    /**
     * @var string $Label
     */
    protected $Label = null;

    /**
     * @var boolean $DefaultConfig
     */
    protected $DefaultConfig = null;

    /**
     * @param int $Id
     * @param string $UID
     * @param string $ExternalId
     * @param \DateTime $removed
     * @param anySimpleType $updated
     * @param anySimpleType $created
     * @param string $Label
     * @param boolean $DefaultConfig
     */
    public function __construct($Id = null, $UID = null, $ExternalId = null, \DateTime $removed = null, $updated = null, $created = null, $Label = null, $DefaultConfig = null)
    {
      parent::__construct($Id, $UID, $ExternalId, $removed, $updated, $created);
      $this->Label = $Label;
      $this->DefaultConfig = $DefaultConfig;
    }

    /**
     * @return ArrayOfRecord
     */
    public function getTaxes()
    {
      return $this->Taxes;
    }

    /**
     * @param ArrayOfRecord $Taxes
     * @return \ProgressionWebService\TaxConfig
     */
    public function setTaxes($Taxes)
    {
      $this->Taxes = $Taxes;
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
     * @return \ProgressionWebService\TaxConfig
     */
    public function setLabel($Label)
    {
      $this->Label = $Label;
      return $this;
    }

    /**
     * @return boolean
     */
    public function getDefaultConfig()
    {
      return $this->DefaultConfig;
    }

    /**
     * @param boolean $DefaultConfig
     * @return \ProgressionWebService\TaxConfig
     */
    public function setDefaultConfig($DefaultConfig)
    {
      $this->DefaultConfig = $DefaultConfig;
      return $this;
    }

}
