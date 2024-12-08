<?php

namespace ProgressionWebService;

abstract class Record
{

    /**
     * @var ArrayOfProperty $Metas
     */
    protected $Metas = null;

    /**
     * @var ArrayOfProperty $Properties
     */
    protected $Properties = null;

    /**
     * @var ArrayOfRecordRef $Tags
     */
    protected $Tags = null;

    /**
     * @var ArrayOfRecordRef $Comments
     */
    protected $Comments = null;

    /**
     * @var RecordRef $CreatorRef
     */
    protected $CreatorRef = null;

    /**
     * @var int $Id
     */
    protected $Id = null;

    /**
     * @var string $UID
     */
    protected $UID = null;

    /**
     * @var string $ExternalId
     */
    protected $ExternalId = null;

    /**
     * @var \DateTime $removed
     */
    protected $removed = null;

    /**
     * @var anySimpleType $updated
     */
    protected $updated = null;

    /**
     * @var anySimpleType $created
     */
    protected $created = null;

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
      $this->Id = $Id;
      $this->UID = $UID;
      $this->ExternalId = $ExternalId;
      $this->removed = $removed ? $removed->format(\DateTime::ATOM) : null;
      $this->updated = $updated;
      $this->created = $created;
    }

    /**
     * @return ArrayOfProperty
     */
    public function getMetas()
    {
      return $this->Metas;
    }

    /**
     * @param ArrayOfProperty $Metas
     * @return \ProgressionWebService\Record
     */
    public function setMetas($Metas)
    {
      $this->Metas = $Metas;
      return $this;
    }

    /**
     * @return ArrayOfProperty
     */
    public function getProperties()
    {
      return $this->Properties;
    }

    /**
     * @param ArrayOfProperty $Properties
     * @return \ProgressionWebService\Record
     */
    public function setProperties($Properties)
    {
      $this->Properties = $Properties;
      return $this;
    }

    /**
     * @return ArrayOfRecordRef
     */
    public function getTags()
    {
      return $this->Tags;
    }

    /**
     * @param ArrayOfRecordRef $Tags
     * @return \ProgressionWebService\Record
     */
    public function setTags($Tags)
    {
      $this->Tags = $Tags;
      return $this;
    }

    /**
     * @return ArrayOfRecordRef
     */
    public function getComments()
    {
      return $this->Comments;
    }

    /**
     * @param ArrayOfRecordRef $Comments
     * @return \ProgressionWebService\Record
     */
    public function setComments($Comments)
    {
      $this->Comments = $Comments;
      return $this;
    }

    /**
     * @return RecordRef
     */
    public function getCreatorRef()
    {
      return $this->CreatorRef;
    }

    /**
     * @param RecordRef $CreatorRef
     * @return \ProgressionWebService\Record
     */
    public function setCreatorRef($CreatorRef)
    {
      $this->CreatorRef = $CreatorRef;
      return $this;
    }

    /**
     * @return int
     */
    public function getId()
    {
      return $this->Id;
    }

    /**
     * @param int $Id
     * @return \ProgressionWebService\Record
     */
    public function setId($Id)
    {
      $this->Id = $Id;
      return $this;
    }

    /**
     * @return string
     */
    public function getUID()
    {
      return $this->UID;
    }

    /**
     * @param string $UID
     * @return \ProgressionWebService\Record
     */
    public function setUID($UID)
    {
      $this->UID = $UID;
      return $this;
    }

    /**
     * @return string
     */
    public function getExternalId()
    {
      return $this->ExternalId;
    }

    /**
     * @param string $ExternalId
     * @return \ProgressionWebService\Record
     */
    public function setExternalId($ExternalId)
    {
      $this->ExternalId = $ExternalId;
      return $this;
    }

    /**
     * @return \DateTime
     */
    public function getRemoved()
    {
      if ($this->removed == null) {
        return null;
      } else {
        try {
          return new \DateTime($this->removed);
        } catch (\Exception $e) {
          return false;
        }
      }
    }

    /**
     * @param \DateTime $removed
     * @return \ProgressionWebService\Record
     */
    public function setRemoved(\DateTime $removed)
    {
      $this->removed = $removed->format(\DateTime::ATOM);
      return $this;
    }

    /**
     * @return anySimpleType
     */
    public function getUpdated()
    {
      return $this->updated;
    }

    /**
     * @param anySimpleType $updated
     * @return \ProgressionWebService\Record
     */
    public function setUpdated($updated)
    {
      $this->updated = $updated;
      return $this;
    }

    /**
     * @return anySimpleType
     */
    public function getCreated()
    {
      return $this->created;
    }

    /**
     * @param anySimpleType $created
     * @return \ProgressionWebService\Record
     */
    public function setCreated($created)
    {
      $this->created = $created;
      return $this;
    }

}
