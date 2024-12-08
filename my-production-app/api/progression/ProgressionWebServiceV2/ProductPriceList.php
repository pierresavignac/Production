<?php

namespace ProgressionWebService;

class ProductPriceList extends Record
{

    /**
     * @var ArrayOfRecord $ProductPrices
     */
    protected $ProductPrices = null;

    /**
     * @var string $Label
     */
    protected $Label = null;

    /**
     * @var boolean $Exclusive
     */
    protected $Exclusive = null;

    /**
     * @param int $Id
     * @param string $UID
     * @param string $ExternalId
     * @param \DateTime $removed
     * @param anySimpleType $updated
     * @param anySimpleType $created
     * @param string $Label
     * @param boolean $Exclusive
     */
    public function __construct($Id = null, $UID = null, $ExternalId = null, \DateTime $removed = null, $updated = null, $created = null, $Label = null, $Exclusive = null)
    {
      parent::__construct($Id, $UID, $ExternalId, $removed, $updated, $created);
      $this->Label = $Label;
      $this->Exclusive = $Exclusive;
    }

    /**
     * @return ArrayOfRecord
     */
    public function getProductPrices()
    {
      return $this->ProductPrices;
    }

    /**
     * @param ArrayOfRecord $ProductPrices
     * @return \ProgressionWebService\ProductPriceList
     */
    public function setProductPrices($ProductPrices)
    {
      $this->ProductPrices = $ProductPrices;
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
     * @return \ProgressionWebService\ProductPriceList
     */
    public function setLabel($Label)
    {
      $this->Label = $Label;
      return $this;
    }

    /**
     * @return boolean
     */
    public function getExclusive()
    {
      return $this->Exclusive;
    }

    /**
     * @param boolean $Exclusive
     * @return \ProgressionWebService\ProductPriceList
     */
    public function setExclusive($Exclusive)
    {
      $this->Exclusive = $Exclusive;
      return $this;
    }

}
