<?php

namespace ProgressionWebService;

class Todo extends Record
{

    /**
     * @var RecordRef $ClientRef
     */
    protected $ClientRef = null;

    /**
     * @var RecordRef $NodeRef
     */
    protected $NodeRef = null;

    /**
     * @var \DateTime $DueDate
     */
    protected $DueDate = null;

    /**
     * @var \DateTime $CompletionDate
     */
    protected $CompletionDate = null;

    /**
     * @var string $Label
     */
    protected $Label = null;

    /**
     * @var string $Description
     */
    protected $Description = null;

    /**
     * @param int $Id
     * @param string $UID
     * @param string $ExternalId
     * @param \DateTime $removed
     * @param anySimpleType $updated
     * @param anySimpleType $created
     * @param string $Label
     * @param string $Description
     */
    public function __construct($Id = null, $UID = null, $ExternalId = null, \DateTime $removed = null, $updated = null, $created = null, $Label = null, $Description = null)
    {
      parent::__construct($Id, $UID, $ExternalId, $removed, $updated, $created);
      $this->Label = $Label;
      $this->Description = $Description;
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
     * @return \ProgressionWebService\Todo
     */
    public function setClientRef($ClientRef)
    {
      $this->ClientRef = $ClientRef;
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
     * @return \ProgressionWebService\Todo
     */
    public function setNodeRef($NodeRef)
    {
      $this->NodeRef = $NodeRef;
      return $this;
    }

    /**
     * @return \DateTime
     */
    public function getDueDate()
    {
      if ($this->DueDate == null) {
        return null;
      } else {
        try {
          return new \DateTime($this->DueDate);
        } catch (\Exception $e) {
          return false;
        }
      }
    }

    /**
     * @param \DateTime $DueDate
     * @return \ProgressionWebService\Todo
     */
    public function setDueDate(\DateTime $DueDate = null)
    {
      if ($DueDate == null) {
       $this->DueDate = null;
      } else {
        $this->DueDate = $DueDate->format(\DateTime::ATOM);
      }
      return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCompletionDate()
    {
      if ($this->CompletionDate == null) {
        return null;
      } else {
        try {
          return new \DateTime($this->CompletionDate);
        } catch (\Exception $e) {
          return false;
        }
      }
    }

    /**
     * @param \DateTime $CompletionDate
     * @return \ProgressionWebService\Todo
     */
    public function setCompletionDate(\DateTime $CompletionDate = null)
    {
      if ($CompletionDate == null) {
       $this->CompletionDate = null;
      } else {
        $this->CompletionDate = $CompletionDate->format(\DateTime::ATOM);
      }
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
     * @return \ProgressionWebService\Todo
     */
    public function setLabel($Label)
    {
      $this->Label = $Label;
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
     * @return \ProgressionWebService\Todo
     */
    public function setDescription($Description)
    {
      $this->Description = $Description;
      return $this;
    }

}
