<?php

namespace ProgressionWebService;

class TaskItemList extends Record
{

    /**
     * @var ArrayOfRecord $TaskItems
     */
    protected $TaskItems = null;

    /**
     * @var ArrayOfRecord $TaxAmounts
     */
    protected $TaxAmounts = null;

    /**
     * @var float $SubTotal
     */
    protected $SubTotal = null;

    /**
     * @var float $RoundedTotal
     */
    protected $RoundedTotal = null;

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
     * @param float $SubTotal
     * @param float $RoundedTotal
     * @param float $Total
     */
    public function __construct($Id = null, $UID = null, $ExternalId = null, \DateTime $removed = null, $updated = null, $created = null, $SubTotal = null, $RoundedTotal = null, $Total = null)
    {
      parent::__construct($Id, $UID, $ExternalId, $removed, $updated, $created);
      $this->SubTotal = $SubTotal;
      $this->RoundedTotal = $RoundedTotal;
      $this->Total = $Total;
    }

    /**
     * @return ArrayOfRecord
     */
    public function getTaskItems()
    {
      return $this->TaskItems;
    }

    /**
     * @param ArrayOfRecord $TaskItems
     * @return \ProgressionWebService\TaskItemList
     */
    public function setTaskItems($TaskItems)
    {
      $this->TaskItems = $TaskItems;
      return $this;
    }

    /**
     * @return ArrayOfRecord
     */
    public function getTaxAmounts()
    {
      return $this->TaxAmounts;
    }

    /**
     * @param ArrayOfRecord $TaxAmounts
     * @return \ProgressionWebService\TaskItemList
     */
    public function setTaxAmounts($TaxAmounts)
    {
      $this->TaxAmounts = $TaxAmounts;
      return $this;
    }

    /**
     * @return float
     */
    public function getSubTotal()
    {
      return $this->SubTotal;
    }

    /**
     * @param float $SubTotal
     * @return \ProgressionWebService\TaskItemList
     */
    public function setSubTotal($SubTotal)
    {
      $this->SubTotal = $SubTotal;
      return $this;
    }

    /**
     * @return float
     */
    public function getRoundedTotal()
    {
      return $this->RoundedTotal;
    }

    /**
     * @param float $RoundedTotal
     * @return \ProgressionWebService\TaskItemList
     */
    public function setRoundedTotal($RoundedTotal)
    {
      $this->RoundedTotal = $RoundedTotal;
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
     * @return \ProgressionWebService\TaskItemList
     */
    public function setTotal($Total)
    {
      $this->Total = $Total;
      return $this;
    }

}
