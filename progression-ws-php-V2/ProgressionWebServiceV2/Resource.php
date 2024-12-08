<?php

namespace ProgressionWebService;

class Resource extends Record
{

    /**
     * @var RecordRef $TypeRef
     */
    protected $TypeRef = null;

    /**
     * @var RecordRef $ClientRef
     */
    protected $ClientRef = null;

    /**
     * @var RecordRef $NodeRef
     */
    protected $NodeRef = null;

    /**
     * @var RecordRef $HumanResourceRef
     */
    protected $HumanResourceRef = null;

    /**
     * @var ArrayOfRecordRef $AttachmentRefs
     */
    protected $AttachmentRefs = null;

    /**
     * @var string $Label
     */
    protected $Label = null;

    /**
     * @param int $Id
     * @param string $UID
     * @param string $ExternalId
     * @param \DateTime $removed
     * @param anySimpleType $updated
     * @param anySimpleType $created
     * @param RecordRef $TypeRef
     * @param RecordRef $ClientRef
     * @param RecordRef $NodeRef
     * @param string $Label
     */
    public function __construct($Id = null, $UID = null, $ExternalId = null, \DateTime $removed = null, $updated = null, $created = null, $TypeRef = null, $ClientRef = null, $NodeRef = null, $Label = null)
    {
      parent::__construct($Id, $UID, $ExternalId, $removed, $updated, $created);
      $this->TypeRef = $TypeRef;
      $this->ClientRef = $ClientRef;
      $this->NodeRef = $NodeRef;
      $this->Label = $Label;
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
     * @return \ProgressionWebService\Resource
     */
    public function setTypeRef($TypeRef)
    {
      $this->TypeRef = $TypeRef;
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
     * @return \ProgressionWebService\Resource
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
     * @return \ProgressionWebService\Resource
     */
    public function setNodeRef($NodeRef)
    {
      $this->NodeRef = $NodeRef;
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
     * @return \ProgressionWebService\Resource
     */
    public function setHumanResourceRef($HumanResourceRef)
    {
      $this->HumanResourceRef = $HumanResourceRef;
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
     * @return \ProgressionWebService\Resource
     */
    public function setAttachmentRefs($AttachmentRefs)
    {
      $this->AttachmentRefs = $AttachmentRefs;
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
     * @return \ProgressionWebService\Resource
     */
    public function setLabel($Label)
    {
      $this->Label = $Label;
      return $this;
    }

}
