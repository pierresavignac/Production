<?php

namespace ProgressionWebService;

class WorkingPlanWindow extends Record
{

    /**
     * @var RecordRef $TypeRef
     */
    protected $TypeRef = null;

    /**
     * @var \DateTime $DateTimeFrom
     */
    protected $DateTimeFrom = null;

    /**
     * @var \DateTime $DateTimeTo
     */
    protected $DateTimeTo = null;

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
     */
    public function __construct($Id = null, $UID = null, $ExternalId = null, \DateTime $removed = null, $updated = null, $created = null, $TypeRef = null, \DateTime $DateTimeFrom = null, \DateTime $DateTimeTo = null)
    {
      parent::__construct($Id, $UID, $ExternalId, $removed, $updated, $created);
      $this->TypeRef = $TypeRef;
      $this->DateTimeFrom = $DateTimeFrom ? $DateTimeFrom->format(\DateTime::ATOM) : null;
      $this->DateTimeTo = $DateTimeTo ? $DateTimeTo->format(\DateTime::ATOM) : null;
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
     * @return \ProgressionWebService\WorkingPlanWindow
     */
    public function setTypeRef($TypeRef)
    {
      $this->TypeRef = $TypeRef;
      return $this;
    }

    /**
     * @return \DateTime
     */
    public function getDateTimeFrom()
    {
      if ($this->DateTimeFrom == null) {
        return null;
      } else {
        try {
          return new \DateTime($this->DateTimeFrom);
        } catch (\Exception $e) {
          return false;
        }
      }
    }

    /**
     * @param \DateTime $DateTimeFrom
     * @return \ProgressionWebService\WorkingPlanWindow
     */
    public function setDateTimeFrom(\DateTime $DateTimeFrom)
    {
      $this->DateTimeFrom = $DateTimeFrom->format(\DateTime::ATOM);
      return $this;
    }

    /**
     * @return \DateTime
     */
    public function getDateTimeTo()
    {
      if ($this->DateTimeTo == null) {
        return null;
      } else {
        try {
          return new \DateTime($this->DateTimeTo);
        } catch (\Exception $e) {
          return false;
        }
      }
    }

    /**
     * @param \DateTime $DateTimeTo
     * @return \ProgressionWebService\WorkingPlanWindow
     */
    public function setDateTimeTo(\DateTime $DateTimeTo)
    {
      $this->DateTimeTo = $DateTimeTo->format(\DateTime::ATOM);
      return $this;
    }

}
