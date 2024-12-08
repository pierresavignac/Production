<?php

namespace ProgressionWebService;

class Task extends Record
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
     * @var RecordRef $PrimaryTagRef
     */
    protected $PrimaryTagRef = null;

    /**
     * @var RecordRef $HumanResourceRef
     */
    protected $HumanResourceRef = null;

    /**
     * @var ArrayOfRecordRef $HelpersRefs
     */
    protected $HelpersRefs = null;

    /**
     * @var ArrayOfRecord $TimeEntry
     */
    protected $TimeEntry = null;

    /**
     * @var string $Code
     */
    protected $Code = null;

    /**
     * @var string $Summary
     */
    protected $Summary = null;

    /**
     * @var string $Description
     */
    protected $Description = null;

    /**
     * @var \DateTime $Rv
     */
    protected $Rv = null;

    /**
     * @var int $Index
     */
    protected $Index = null;

    /**
     * @var TaskState $CurrentState
     */
    protected $CurrentState = null;

    /**
     * @var TaskState $StartState
     */
    protected $StartState = null;

    /**
     * @var TaskState $EndState
     */
    protected $EndState = null;

    /**
     * @var ArrayOfRecordRef $AttachmentRefs
     */
    protected $AttachmentRefs = null;

    /**
     * @var TaskItemList $TaskItemList
     */
    protected $TaskItemList = null;

    /**
     * @var RecordRef $SignatureRef
     */
    protected $SignatureRef = null;

    /**
     * @var \DateTime $Sent
     */
    protected $Sent = null;

    /**
     * @var \DateTime $Received
     */
    protected $Received = null;

    /**
     * @var \DateTime $Cancelled
     */
    protected $Cancelled = null;

    /**
     * @var \DateTime $Opened
     */
    protected $Opened = null;

    /**
     * @var int $Duration
     */
    protected $Duration = null;

    /**
     * @var int $ActualDuration
     */
    protected $ActualDuration = null;

    /**
     * @var int $TravelTime
     */
    protected $TravelTime = null;

    /**
     * @var int $Delay
     */
    protected $Delay = null;

    /**
     * @var string $SignatureText
     */
    protected $SignatureText = null;

    /**
     * @var RecordRef $TaxConfigRef
     */
    protected $TaxConfigRef = null;

    /**
     * @var RecordRef $ProductPriceListRef
     */
    protected $ProductPriceListRef = null;

    /**
     * @var string $Lang
     */
    protected $Lang = null;

    /**
     * @var ArrayOfRecordRef $TaskCommentRefs
     */
    protected $TaskCommentRefs = null;

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
     * @var ArrayOfRecordRef $ResourceRefs
     */
    protected $ResourceRefs = null;

    /**
     * @var ArrayOfRecordRef $TodoRefs
     */
    protected $TodoRefs = null;

    /**
     * @var ArrayOfRecordRef $ContactRefs
     */
    protected $ContactRefs = null;

    /**
     * @var TaskOptim $TaskOptim
     */
    protected $TaskOptim = null;

    /**
     * @var RecordRef $TaskGroupRef
     */
    protected $TaskGroupRef = null;

    /**
     * @var RecordRef $TaskScheduleRef
     */
    protected $TaskScheduleRef = null;

    /**
     * @param int $Id
     * @param string $UID
     * @param string $ExternalId
     * @param \DateTime $removed
     * @param anySimpleType $updated
     * @param anySimpleType $created
     * @param RecordRef $TypeRef
     * @param RecordRef $HumanResourceRef
     * @param RecordRef $ClientRef
     * @param RecordRef $NodeRef
     */
    public function __construct($Id = null, $UID = null, $ExternalId = null, \DateTime $removed = null, $updated = null, $created = null, $TypeRef = null, $HumanResourceRef = null, $ClientRef = null, $NodeRef = null)
    {
      parent::__construct($Id, $UID, $ExternalId, $removed, $updated, $created);
      $this->TypeRef = $TypeRef;
      $this->HumanResourceRef = $HumanResourceRef;
      $this->ClientRef = $ClientRef;
      $this->NodeRef = $NodeRef;
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
     * @return \ProgressionWebService\Task
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
     * @return \ProgressionWebService\Task
     */
    public function setPriorityRef($PriorityRef)
    {
      $this->PriorityRef = $PriorityRef;
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
     * @return \ProgressionWebService\Task
     */
    public function setPrimaryTagRef($PrimaryTagRef)
    {
      $this->PrimaryTagRef = $PrimaryTagRef;
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
     * @return \ProgressionWebService\Task
     */
    public function setHumanResourceRef($HumanResourceRef)
    {
      $this->HumanResourceRef = $HumanResourceRef;
      return $this;
    }

    /**
     * @return ArrayOfRecordRef
     */
    public function getHelpersRefs()
    {
      return $this->HelpersRefs;
    }

    /**
     * @param ArrayOfRecordRef $HelpersRefs
     * @return \ProgressionWebService\Task
     */
    public function setHelpersRefs($HelpersRefs)
    {
      $this->HelpersRefs = $HelpersRefs;
      return $this;
    }

    /**
     * @return ArrayOfRecord
     */
    public function getTimeEntry()
    {
      return $this->TimeEntry;
    }

    /**
     * @param ArrayOfRecord $TimeEntry
     * @return \ProgressionWebService\Task
     */
    public function setTimeEntry($TimeEntry)
    {
      $this->TimeEntry = $TimeEntry;
      return $this;
    }

    /**
     * @return string
     */
    public function getCode()
    {
      return $this->Code;
    }

    /**
     * @param string $Code
     * @return \ProgressionWebService\Task
     */
    public function setCode($Code)
    {
      $this->Code = $Code;
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
     * @return \ProgressionWebService\Task
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
     * @return \ProgressionWebService\Task
     */
    public function setDescription($Description)
    {
      $this->Description = $Description;
      return $this;
    }

    /**
     * @return \DateTime
     */
    public function getRv()
    {
      if ($this->Rv == null) {
        return null;
      } else {
        try {
          return new \DateTime($this->Rv);
        } catch (\Exception $e) {
          return false;
        }
      }
    }

    /**
     * @param \DateTime $Rv
     * @return \ProgressionWebService\Task
     */
    public function setRv(\DateTime $Rv = null)
    {
      if ($Rv == null) {
       $this->Rv = null;
      } else {
        $this->Rv = $Rv->format(\DateTime::ATOM);
      }
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
     * @return \ProgressionWebService\Task
     */
    public function setIndex($Index)
    {
      $this->Index = $Index;
      return $this;
    }

    /**
     * @return TaskState
     */
    public function getCurrentState()
    {
      return $this->CurrentState;
    }

    /**
     * @param TaskState $CurrentState
     * @return \ProgressionWebService\Task
     */
    public function setCurrentState($CurrentState)
    {
      $this->CurrentState = $CurrentState;
      return $this;
    }

    /**
     * @return TaskState
     */
    public function getStartState()
    {
      return $this->StartState;
    }

    /**
     * @param TaskState $StartState
     * @return \ProgressionWebService\Task
     */
    public function setStartState($StartState)
    {
      $this->StartState = $StartState;
      return $this;
    }

    /**
     * @return TaskState
     */
    public function getEndState()
    {
      return $this->EndState;
    }

    /**
     * @param TaskState $EndState
     * @return \ProgressionWebService\Task
     */
    public function setEndState($EndState)
    {
      $this->EndState = $EndState;
      return $this;
    }

    /**
     * @return ArrayOfRecordRef
     */
    public function getAttachmentRefs()
    {
      return $this->AttachmentRefs;
    }

    /**
     * @param ArrayOfRecordRef $AttachmentRefs
     * @return \ProgressionWebService\Task
     */
    public function setAttachmentRefs($AttachmentRefs)
    {
      $this->AttachmentRefs = $AttachmentRefs;
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
     * @return \ProgressionWebService\Task
     */
    public function setTaskItemList($TaskItemList)
    {
      $this->TaskItemList = $TaskItemList;
      return $this;
    }

    /**
     * @return RecordRef
     */
    public function getSignatureRef()
    {
      return $this->SignatureRef;
    }

    /**
     * @param RecordRef $SignatureRef
     * @return \ProgressionWebService\Task
     */
    public function setSignatureRef($SignatureRef)
    {
      $this->SignatureRef = $SignatureRef;
      return $this;
    }

    /**
     * @return \DateTime
     */
    public function getSent()
    {
      if ($this->Sent == null) {
        return null;
      } else {
        try {
          return new \DateTime($this->Sent);
        } catch (\Exception $e) {
          return false;
        }
      }
    }

    /**
     * @param \DateTime $Sent
     * @return \ProgressionWebService\Task
     */
    public function setSent(\DateTime $Sent = null)
    {
      if ($Sent == null) {
       $this->Sent = null;
      } else {
        $this->Sent = $Sent->format(\DateTime::ATOM);
      }
      return $this;
    }

    /**
     * @return \DateTime
     */
    public function getReceived()
    {
      if ($this->Received == null) {
        return null;
      } else {
        try {
          return new \DateTime($this->Received);
        } catch (\Exception $e) {
          return false;
        }
      }
    }

    /**
     * @param \DateTime $Received
     * @return \ProgressionWebService\Task
     */
    public function setReceived(\DateTime $Received = null)
    {
      if ($Received == null) {
       $this->Received = null;
      } else {
        $this->Received = $Received->format(\DateTime::ATOM);
      }
      return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCancelled()
    {
      if ($this->Cancelled == null) {
        return null;
      } else {
        try {
          return new \DateTime($this->Cancelled);
        } catch (\Exception $e) {
          return false;
        }
      }
    }

    /**
     * @param \DateTime $Cancelled
     * @return \ProgressionWebService\Task
     */
    public function setCancelled(\DateTime $Cancelled = null)
    {
      if ($Cancelled == null) {
       $this->Cancelled = null;
      } else {
        $this->Cancelled = $Cancelled->format(\DateTime::ATOM);
      }
      return $this;
    }

    /**
     * @return \DateTime
     */
    public function getOpened()
    {
      if ($this->Opened == null) {
        return null;
      } else {
        try {
          return new \DateTime($this->Opened);
        } catch (\Exception $e) {
          return false;
        }
      }
    }

    /**
     * @param \DateTime $Opened
     * @return \ProgressionWebService\Task
     */
    public function setOpened(\DateTime $Opened = null)
    {
      if ($Opened == null) {
       $this->Opened = null;
      } else {
        $this->Opened = $Opened->format(\DateTime::ATOM);
      }
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
     * @return \ProgressionWebService\Task
     */
    public function setDuration($Duration)
    {
      $this->Duration = $Duration;
      return $this;
    }

    /**
     * @return int
     */
    public function getActualDuration()
    {
      return $this->ActualDuration;
    }

    /**
     * @param int $ActualDuration
     * @return \ProgressionWebService\Task
     */
    public function setActualDuration($ActualDuration)
    {
      $this->ActualDuration = $ActualDuration;
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
     * @return \ProgressionWebService\Task
     */
    public function setTravelTime($TravelTime)
    {
      $this->TravelTime = $TravelTime;
      return $this;
    }

    /**
     * @return int
     */
    public function getDelay()
    {
      return $this->Delay;
    }

    /**
     * @param int $Delay
     * @return \ProgressionWebService\Task
     */
    public function setDelay($Delay)
    {
      $this->Delay = $Delay;
      return $this;
    }

    /**
     * @return string
     */
    public function getSignatureText()
    {
      return $this->SignatureText;
    }

    /**
     * @param string $SignatureText
     * @return \ProgressionWebService\Task
     */
    public function setSignatureText($SignatureText)
    {
      $this->SignatureText = $SignatureText;
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
     * @return \ProgressionWebService\Task
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
     * @return \ProgressionWebService\Task
     */
    public function setProductPriceListRef($ProductPriceListRef)
    {
      $this->ProductPriceListRef = $ProductPriceListRef;
      return $this;
    }

    /**
     * @return string
     */
    public function getLang()
    {
      return $this->Lang;
    }

    /**
     * @param string $Lang
     * @return \ProgressionWebService\Task
     */
    public function setLang($Lang)
    {
      $this->Lang = $Lang;
      return $this;
    }

    /**
     * @return ArrayOfRecordRef
     */
    public function getTaskCommentRefs()
    {
      return $this->TaskCommentRefs;
    }

    /**
     * @param ArrayOfRecordRef $TaskCommentRefs
     * @return \ProgressionWebService\Task
     */
    public function setTaskCommentRefs($TaskCommentRefs)
    {
      $this->TaskCommentRefs = $TaskCommentRefs;
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
     * @return \ProgressionWebService\Task
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
     * @return \ProgressionWebService\Task
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
     * @return \ProgressionWebService\Task
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
     * @return \ProgressionWebService\Task
     */
    public function setNodeAddress($NodeAddress)
    {
      $this->NodeAddress = $NodeAddress;
      return $this;
    }

    /**
     * @return ArrayOfRecordRef
     */
    public function getResourceRefs()
    {
      return $this->ResourceRefs;
    }

    /**
     * @param ArrayOfRecordRef $ResourceRefs
     * @return \ProgressionWebService\Task
     */
    public function setResourceRefs($ResourceRefs)
    {
      $this->ResourceRefs = $ResourceRefs;
      return $this;
    }

    /**
     * @return ArrayOfRecordRef
     */
    public function getTodoRefs()
    {
      return $this->TodoRefs;
    }

    /**
     * @param ArrayOfRecordRef $TodoRefs
     * @return \ProgressionWebService\Task
     */
    public function setTodoRefs($TodoRefs)
    {
      $this->TodoRefs = $TodoRefs;
      return $this;
    }

    /**
     * @return ArrayOfRecordRef
     */
    public function getContactRefs()
    {
      return $this->ContactRefs;
    }

    /**
     * @param ArrayOfRecordRef $ContactRefs
     * @return \ProgressionWebService\Task
     */
    public function setContactRefs($ContactRefs)
    {
      $this->ContactRefs = $ContactRefs;
      return $this;
    }

    /**
     * @return TaskOptim
     */
    public function getTaskOptim()
    {
      return $this->TaskOptim;
    }

    /**
     * @param TaskOptim $TaskOptim
     * @return \ProgressionWebService\Task
     */
    public function setTaskOptim($TaskOptim)
    {
      $this->TaskOptim = $TaskOptim;
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
     * @return \ProgressionWebService\Task
     */
    public function setTaskGroupRef($TaskGroupRef)
    {
      $this->TaskGroupRef = $TaskGroupRef;
      return $this;
    }

    /**
     * @return RecordRef
     */
    public function getTaskScheduleRef()
    {
      return $this->TaskScheduleRef;
    }

    /**
     * @param RecordRef $TaskScheduleRef
     * @return \ProgressionWebService\Task
     */
    public function setTaskScheduleRef($TaskScheduleRef)
    {
      $this->TaskScheduleRef = $TaskScheduleRef;
      return $this;
    }

}
