<?php

namespace ProgressionWebService;

class TaskScheduleTemplate extends Record
{

    /**
     * @var RecordRef $TypeRef
     */
    protected $TypeRef = null;

    /**
     * @var RecordRef $PriorityRef
     */
    protected $PriorityRef = null;

    /**
     * @var RecordRef $HumanResourceRef
     */
    protected $HumanResourceRef = null;

    /**
     * @var string $Summary
     */
    protected $Summary = null;

    /**
     * @var string $Description
     */
    protected $Description = null;

    /**
     * @var int $Index
     */
    protected $Index = null;

    /**
     * @var int $Duration
     */
    protected $Duration = null;

    /**
     * @var int $TravelTime
     */
    protected $TravelTime = null;

    /**
     * @var RecordRef $ClientRef
     */
    protected $ClientRef = null;

    /**
     * @var Address $ClientAddress
     */
    protected $ClientAddress = null;

    /**
     * @var RecordRef $NodeRef
     */
    protected $NodeRef = null;

    /**
     * @var Address $NodeAddress
     */
    protected $NodeAddress = null;

    /**
     * @var RecordRef $PrimaryTagRef
     */
    protected $PrimaryTagRef = null;

    /**
     * @var RecordRef $TaskGroupRef
     */
    protected $TaskGroupRef = null;

    /**
     * @var TaskItemList $TaskItemList
     */
    protected $TaskItemList = null;

    /**
     * @var RecordRef $TaxConfigRef
     */
    protected $TaxConfigRef = null;

    /**
     * @var RecordRef $ProductPriceListRef
     */
    protected $ProductPriceListRef = null;

    /**
     * @param int $Id
     * @param string $UID
     * @param string $ExternalId
     * @param \DateTime $removed
     * @param anySimpleType $updated
     * @param anySimpleType $created
     */
    public function __construct($Id = null, $UID = null, $ExternalId = null, \DateTime $removed = null, $updated = null, $created = null)
    {
      parent::__construct($Id, $UID, $ExternalId, $removed, $updated, $created);
    }

    /**
     * @return RecordRef
     */
    public function getTypeRef()
    {
      return $this->TypeRef;
    }

    /**
     * @param RecordRef $TypeRef
     * @return \ProgressionWebService\TaskScheduleTemplate
     */
    public function setTypeRef($TypeRef)
    {
      $this->TypeRef = $TypeRef;
      return $this;
    }

    /**
     * @return RecordRef
     */
    public function getPriorityRef()
    {
      return $this->PriorityRef;
    }

    /**
     * @param RecordRef $PriorityRef
     * @return \ProgressionWebService\TaskScheduleTemplate
     */
    public function setPriorityRef($PriorityRef)
    {
      $this->PriorityRef = $PriorityRef;
      return $this;
    }

    /**
     * @return RecordRef
     */
    public function getHumanResourceRef()
    {
      return $this->HumanResourceRef;
    }

    /**
     * @param RecordRef $HumanResourceRef
     * @return \ProgressionWebService\TaskScheduleTemplate
     */
    public function setHumanResourceRef($HumanResourceRef)
    {
      $this->HumanResourceRef = $HumanResourceRef;
      return $this;
    }

    /**
     * @return string
     */
    public function getSummary()
    {
      return $this->Summary;
    }

    /**
     * @param string $Summary
     * @return \ProgressionWebService\TaskScheduleTemplate
     */
    public function setSummary($Summary)
    {
      $this->Summary = $Summary;
      return $this;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
      return $this->Description;
    }

    /**
     * @param string $Description
     * @return \ProgressionWebService\TaskScheduleTemplate
     */
    public function setDescription($Description)
    {
      $this->Description = $Description;
      return $this;
    }

    /**
     * @return int
     */
    public function getIndex()
    {
      return $this->Index;
    }

    /**
     * @param int $Index
     * @return \ProgressionWebService\TaskScheduleTemplate
     */
    public function setIndex($Index)
    {
      $this->Index = $Index;
      return $this;
    }

    /**
     * @return int
     */
    public function getDuration()
    {
      return $this->Duration;
    }

    /**
     * @param int $Duration
     * @return \ProgressionWebService\TaskScheduleTemplate
     */
    public function setDuration($Duration)
    {
      $this->Duration = $Duration;
      return $this;
    }

    /**
     * @return int
     */
    public function getTravelTime()
    {
      return $this->TravelTime;
    }

    /**
     * @param int $TravelTime
     * @return \ProgressionWebService\TaskScheduleTemplate
     */
    public function setTravelTime($TravelTime)
    {
      $this->TravelTime = $TravelTime;
      return $this;
    }

    /**
     * @return RecordRef
     */
    public function getClientRef()
    {
      return $this->ClientRef;
    }

    /**
     * @param RecordRef $ClientRef
     * @return \ProgressionWebService\TaskScheduleTemplate
     */
    public function setClientRef($ClientRef)
    {
      $this->ClientRef = $ClientRef;
      return $this;
    }

    /**
     * @return Address
     */
    public function getClientAddress()
    {
      return $this->ClientAddress;
    }

    /**
     * @param Address $ClientAddress
     * @return \ProgressionWebService\TaskScheduleTemplate
     */
    public function setClientAddress($ClientAddress)
    {
      $this->ClientAddress = $ClientAddress;
      return $this;
    }

    /**
     * @return RecordRef
     */
    public function getNodeRef()
    {
      return $this->NodeRef;
    }

    /**
     * @param RecordRef $NodeRef
     * @return \ProgressionWebService\TaskScheduleTemplate
     */
    public function setNodeRef($NodeRef)
    {
      $this->NodeRef = $NodeRef;
      return $this;
    }

    /**
     * @return Address
     */
    public function getNodeAddress()
    {
      return $this->NodeAddress;
    }

    /**
     * @param Address $NodeAddress
     * @return \ProgressionWebService\TaskScheduleTemplate
     */
    public function setNodeAddress($NodeAddress)
    {
      $this->NodeAddress = $NodeAddress;
      return $this;
    }

    /**
     * @return RecordRef
     */
    public function getPrimaryTagRef()
    {
      return $this->PrimaryTagRef;
    }

    /**
     * @param RecordRef $PrimaryTagRef
     * @return \ProgressionWebService\TaskScheduleTemplate
     */
    public function setPrimaryTagRef($PrimaryTagRef)
    {
      $this->PrimaryTagRef = $PrimaryTagRef;
      return $this;
    }

    /**
     * @return RecordRef
     */
    public function getTaskGroupRef()
    {
      return $this->TaskGroupRef;
    }

    /**
     * @param RecordRef $TaskGroupRef
     * @return \ProgressionWebService\TaskScheduleTemplate
     */
    public function setTaskGroupRef($TaskGroupRef)
    {
      $this->TaskGroupRef = $TaskGroupRef;
      return $this;
    }

    /**
     * @return TaskItemList
     */
    public function getTaskItemList()
    {
      return $this->TaskItemList;
    }

    /**
     * @param TaskItemList $TaskItemList
     * @return \ProgressionWebService\TaskScheduleTemplate
     */
    public function setTaskItemList($TaskItemList)
    {
      $this->TaskItemList = $TaskItemList;
      return $this;
    }

    /**
     * @return RecordRef
     */
    public function getTaxConfigRef()
    {
      return $this->TaxConfigRef;
    }

    /**
     * @param RecordRef $TaxConfigRef
     * @return \ProgressionWebService\TaskScheduleTemplate
     */
    public function setTaxConfigRef($TaxConfigRef)
    {
      $this->TaxConfigRef = $TaxConfigRef;
      return $this;
    }

    /**
     * @return RecordRef
     */
    public function getProductPriceListRef()
    {
      return $this->ProductPriceListRef;
    }

    /**
     * @param RecordRef $ProductPriceListRef
     * @return \ProgressionWebService\TaskScheduleTemplate
     */
    public function setProductPriceListRef($ProductPriceListRef)
    {
      $this->ProductPriceListRef = $ProductPriceListRef;
      return $this;
    }

}
