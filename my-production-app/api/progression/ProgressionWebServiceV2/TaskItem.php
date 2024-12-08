<?php

namespace ProgressionWebService;

class TaskItem extends Record
{

    /**
     * @var RecordRef $TaskItemTypeRef
     */
    protected $TaskItemTypeRef = null;

    /**
     * @var ArrayOfRecordRef $RelatedItems
     */
    protected $RelatedItems = null;

    /**
     * @var RecordRef $ProductRef
     */
    protected $ProductRef = null;

    /**
     * @var string $Label
     */
    protected $Label = null;

    /**
     * @var float $Price
     */
    protected $Price = null;

    /**
     * @var float $Quantity
     */
    protected $Quantity = null;

    /**
     * @var float $QuantityConfirmed
     */
    protected $QuantityConfirmed = null;

    /**
     * @var float $Rebate
     */
    protected $Rebate = null;

    /**
     * @var boolean $Taxable
     */
    protected $Taxable = null;

    /**
     * @var float $Total
     */
    protected $Total = null;

    /**
     * @param int $Id
     * @param string $UID
     * @param string $ExternalId
     * @param \DateTime $removed
     * @param anySimpleType $updated
     * @param anySimpleType $created
     * @param string $Label
     * @param float $Price
     * @param float $Quantity
     * @param float $QuantityConfirmed
     * @param float $Rebate
     * @param boolean $Taxable
     * @param float $Total
     */
    public function __construct($Id = null, $UID = null, $ExternalId = null, \DateTime $removed = null, $updated = null, $created = null, $Label = null, $Price = null, $Quantity = null, $QuantityConfirmed = null, $Rebate = null, $Taxable = null, $Total = null)
    {
      parent::__construct($Id, $UID, $ExternalId, $removed, $updated, $created);
      $this->Label = $Label;
      $this->Price = $Price;
      $this->Quantity = $Quantity;
      $this->QuantityConfirmed = $QuantityConfirmed;
      $this->Rebate = $Rebate;
      $this->Taxable = $Taxable;
      $this->Total = $Total;
    }

    /**
     * @return RecordRef
     */
    public function getTaskItemTypeRef()
    {
      return $this->TaskItemTypeRef;
    }

    /**
     * @param RecordRef $TaskItemTypeRef
     * @return \ProgressionWebService\TaskItem
     */
    public function setTaskItemTypeRef($TaskItemTypeRef)
    {
      $this->TaskItemTypeRef = $TaskItemTypeRef;
      return $this;
    }

    /**
     * @return ArrayOfRecordRef
     */
    public function getRelatedItems()
    {
      return $this->RelatedItems;
    }

    /**
     * @param ArrayOfRecordRef $RelatedItems
     * @return \ProgressionWebService\TaskItem
     */
    public function setRelatedItems($RelatedItems)
    {
      $this->RelatedItems = $RelatedItems;
      return $this;
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
     * @return \ProgressionWebService\TaskItem
     */
    public function setProductRef($ProductRef)
    {
      $this->ProductRef = $ProductRef;
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
     * @return \ProgressionWebService\TaskItem
     */
    public function setLabel($Label)
    {
      $this->Label = $Label;
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
     * @return \ProgressionWebService\TaskItem
     */
    public function setPrice($Price)
    {
      $this->Price = $Price;
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
     * @return \ProgressionWebService\TaskItem
     */
    public function setQuantity($Quantity)
    {
      $this->Quantity = $Quantity;
      return $this;
    }

    /**
     * @return float
     */
    public function getQuantityConfirmed()
    {
      return $this->QuantityConfirmed;
    }

    /**
     * @param float $QuantityConfirmed
     * @return \ProgressionWebService\TaskItem
     */
    public function setQuantityConfirmed($QuantityConfirmed)
    {
      $this->QuantityConfirmed = $QuantityConfirmed;
      return $this;
    }

    /**
     * @return float
     */
    public function getRebate()
    {
      return $this->Rebate;
    }

    /**
     * @param float $Rebate
     * @return \ProgressionWebService\TaskItem
     */
    public function setRebate($Rebate)
    {
      $this->Rebate = $Rebate;
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
     * @return \ProgressionWebService\TaskItem
     */
    public function setTaxable($Taxable)
    {
      $this->Taxable = $Taxable;
      return $this;
    }

    /**
     * @return float
     */
    public function getTotal()
    {
      return $this->Total;
    }

    /**
     * @param float $Total
     * @return \ProgressionWebService\TaskItem
     */
    public function setTotal($Total)
    {
      $this->Total = $Total;
      return $this;
    }

}
