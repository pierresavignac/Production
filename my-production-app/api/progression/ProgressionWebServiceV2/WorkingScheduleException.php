<?php

namespace ProgressionWebService;

class WorkingScheduleException extends WorkingPlanWindow
{

    /**
     * @var string $Comment
     */
    protected $Comment = null;

    /**
     * @var boolean $Available
     */
    protected $Available = null;

    /**
     * @param int $Id
     * @param string $UID
     * @param string $ExternalId
     * @param \DateTime $removed
     * @param anySimpleType $updated
     * @param anySimpleType $created
     * @param RecordRef $TypeRef
     * @param \DateTime $DateTimeFrom
     * @param \DateTime $DateTimeTo
     * @param boolean $Available
     */
    public function __construct($Id = null, $UID = null, $ExternalId = null, \DateTime $removed = null, $updated = null, $created = null, $TypeRef = null, \DateTime $DateTimeFrom = null, \DateTime $DateTimeTo = null, $Available = null)
    {
      parent::__construct($Id, $UID, $ExternalId, $removed, $updated, $created, $TypeRef, $DateTimeFrom, $DateTimeTo);
      $this->Available = $Available;
    }

    /**
     * @return string
     */
    public function getComment()
    {
      return $this->Comment;
    }

    /**
     * @param string $Comment
     * @return \ProgressionWebService\WorkingScheduleException
     */
    public function setComment($Comment)
    {
      $this->Comment = $Comment;
      return $this;
    }

    /**
     * @return boolean
     */
    public function getAvailable()
    {
      return $this->Available;
    }

    /**
     * @param boolean $Available
     * @return \ProgressionWebService\WorkingScheduleException
     */
    public function setAvailable($Available)
    {
      $this->Available = $Available;
      return $this;
    }

}
