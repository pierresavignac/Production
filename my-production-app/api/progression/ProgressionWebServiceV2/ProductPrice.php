<?php

namespace ProgressionWebService;

class ProductPrice extends Record
{

    /**
     * @var RecordRef $ProductRef
     */
    protected $ProductRef = null;

    /**
     * @var float $Price
     */
    protected $Price = null;

    /**
     * @param int $Id
     * @param string $UID
     * @param string $ExternalId
     * @param \DateTime $removed
     * @param anySimpleType $updated
     * @param anySimpleType $created
     * @param RecordRef $ProductRef
     * @param float $Price
     */
    public function __construct($Id = null, $UID = null, $ExternalId = null, \DateTime $removed = null, $updated = null, $created = null, $ProductRef = null, $Price = null)
    {
      parent::__construct($Id, $UID, $ExternalId, $removed, $updated, $created);
      $this->ProductRef = $ProductRef;
      $this->Price = $Price;
    }

    /**
     * @return RecordRef
     */
    public function getProductRef()
    {
      return $this->ProductRef;
    }

    /**
     * @param RecordRef $ProductRef
     * @return \ProgressionWebService\ProductPrice
     */
    public function setProductRef($ProductRef)
    {
      $this->ProductRef = $ProductRef;
      return $this;
    }

    /**
     * @return float
     */
    public function getPrice()
    {
      return $this->Price;
    }

    /**
     * @param float $Price
     * @return \ProgressionWebService\ProductPrice
     */
    public function setPrice($Price)
    {
      $this->Price = $Price;
      return $this;
    }

}
