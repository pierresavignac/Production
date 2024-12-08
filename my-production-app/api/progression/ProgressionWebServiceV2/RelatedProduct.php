<?php

namespace ProgressionWebService;

class RelatedProduct extends Record
{

    /**
     * @var RecordRef $RelatedProductRef
     */
    protected $RelatedProductRef = null;

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
     * @param RecordRef $RelatedProductRef
     * @param float $Quantity
     */
    public function __construct($Id = null, $UID = null, $ExternalId = null, \DateTime $removed = null, $updated = null, $created = null, $RelatedProductRef = null, $Quantity = null)
    {
      parent::__construct($Id, $UID, $ExternalId, $removed, $updated, $created);
      $this->RelatedProductRef = $RelatedProductRef;
      $this->Quantity = $Quantity;
    }

    /**
     * @return RecordRef
     */
    public function getRelatedProductRef()
    {
      return $this->RelatedProductRef;
    }

    /**
     * @param RecordRef $RelatedProductRef
     * @return \ProgressionWebService\RelatedProduct
     */
    public function setRelatedProductRef($RelatedProductRef)
    {
      $this->RelatedProductRef = $RelatedProductRef;
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
     * @return \ProgressionWebService\RelatedProduct
     */
    public function setQuantity($Quantity)
    {
      $this->Quantity = $Quantity;
      return $this;
    }

}
