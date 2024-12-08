<?php

namespace ProgressionWebService;

class DynamicEntity extends Record
{

    /**
     * @var string $Label
     */
    protected $Label = null;

    /**
     * @var RecordRef $TypeRef
     */
    protected $TypeRef = null;

    /**
     * @var ArrayOfRecordRef $AttachmentRefs
     */
    protected $AttachmentRefs = null;

    /**
     * @param int $Id
     * @param string $UID
     * @param string $ExternalId
     * @param \DateTime $removed
     * @param anySimpleType $updated
     * @param anySimpleType $created
     * @param string $Label
     * @param RecordRef $TypeRef
     */
    public function __construct($Id = null, $UID = null, $ExternalId = null, \DateTime $removed = null, $updated = null, $created = null, $Label = null, $TypeRef = null)
    {
      parent::__construct($Id, $UID, $ExternalId, $removed, $updated, $created);
      $this->Label = $Label;
      $this->TypeRef = $TypeRef;
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
     * @return \ProgressionWebService\DynamicEntity
     */
    public function setLabel($Label)
    {
      $this->Label = $Label;
      return $this;
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
     * @return \ProgressionWebService\DynamicEntity
     */
    public function setTypeRef($TypeRef)
    {
      $this->TypeRef = $TypeRef;
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
     * @return \ProgressionWebService\DynamicEntity
     */
    public function setAttachmentRefs($AttachmentRefs)
    {
      $this->AttachmentRefs = $AttachmentRefs;
      return $this;
    }

}
