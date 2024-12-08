<?php

namespace ProgressionWebService;

class Node extends Record
{

    /**
     * @var RecordRef $TypeRef
     */
    protected $TypeRef = null;

    /**
     * @var ArrayOfRecordRef $Resources
     */
    protected $Resources = null;

    /**
     * @var Address $Address
     */
    protected $Address = null;

    /**
     * @var RecordRef $ClientRef
     */
    protected $ClientRef = null;

    /**
     * @var ArrayOfRecordRef $ContactRefs
     */
    protected $ContactRefs = null;

    /**
     * @var RecordRef $PrimaryContactRef
     */
    protected $PrimaryContactRef = null;

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
     * @param string $Label
     */
    public function __construct($Id = null, $UID = null, $ExternalId = null, \DateTime $removed = null, $updated = null, $created = null, $TypeRef = null, $Label = null)
    {
      parent::__construct($Id, $UID, $ExternalId, $removed, $updated, $created);
      $this->TypeRef = $TypeRef;
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
     * @return \ProgressionWebService\Node
     */
    public function setTypeRef($TypeRef)
    {
      $this->TypeRef = $TypeRef;
      return $this;
    }

    /**
     * @return ArrayOfRecordRef
     */
    public function getResources()
    {
      return $this->Resources;
    }

    /**
     * @param ArrayOfRecordRef $Resources
     * @return \ProgressionWebService\Node
     */
    public function setResources($Resources)
    {
      $this->Resources = $Resources;
      return $this;
    }

    /**
     * @return Address
     */
    public function getAddress()
    {
      return $this->Address;
    }

    /**
     * @param Address $Address
     * @return \ProgressionWebService\Node
     */
    public function setAddress($Address)
    {
      $this->Address = $Address;
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
     * @return \ProgressionWebService\Node
     */
    public function setClientRef($ClientRef)
    {
      $this->ClientRef = $ClientRef;
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
     * @return \ProgressionWebService\Node
     */
    public function setContactRefs($ContactRefs)
    {
      $this->ContactRefs = $ContactRefs;
      return $this;
    }

    /**
     * @return RecordRef
     */
    public function getPrimaryContactRef()
    {
      return $this->PrimaryContactRef;
    }

    /**
     * @param RecordRef $PrimaryContactRef
     * @return \ProgressionWebService\Node
     */
    public function setPrimaryContactRef($PrimaryContactRef)
    {
      $this->PrimaryContactRef = $PrimaryContactRef;
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
     * @return \ProgressionWebService\Node
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
     * @return \ProgressionWebService\Node
     */
    public function setLabel($Label)
    {
      $this->Label = $Label;
      return $this;
    }

}
