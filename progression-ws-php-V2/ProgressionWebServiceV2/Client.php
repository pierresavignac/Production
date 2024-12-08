<?php

namespace ProgressionWebService;

class Client extends Record
{

    /**
     * @var RecordRef $TypeRef
     */
    protected $TypeRef = null;

    /**
     * @var RecordRef $ProductPriceListRef
     */
    protected $ProductPriceListRef = null;

    /**
     * @var RecordRef $TaxConfigRef
     */
    protected $TaxConfigRef = null;

    /**
     * @var ArrayOfRecordRef $Nodes
     */
    protected $Nodes = null;

    /**
     * @var ArrayOfRecordRef $Resources
     */
    protected $Resources = null;

    /**
     * @var ArrayOfRecordRef $HumanResources
     */
    protected $HumanResources = null;

    /**
     * @var Address $Address
     */
    protected $Address = null;

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
     * @var string $Lang
     */
    protected $Lang = null;

    /**
     * @param int $Id
     * @param string $UID
     * @param string $ExternalId
     * @param \DateTime $removed
     * @param anySimpleType $updated
     * @param anySimpleType $created
     * @param RecordRef $TypeRef
     * @param string $Label
     * @param string $Lang
     */
    public function __construct($Id = null, $UID = null, $ExternalId = null, \DateTime $removed = null, $updated = null, $created = null, $TypeRef = null, $Label = null, $Lang = null)
    {
      parent::__construct($Id, $UID, $ExternalId, $removed, $updated, $created);
      $this->TypeRef = $TypeRef;
      $this->Label = $Label;
      $this->Lang = $Lang;
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
     * @return \ProgressionWebService\Client
     */
    public function setTypeRef($TypeRef)
    {
      $this->TypeRef = $TypeRef;
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
     * @return \ProgressionWebService\Client
     */
    public function setProductPriceListRef($ProductPriceListRef)
    {
      $this->ProductPriceListRef = $ProductPriceListRef;
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
     * @return \ProgressionWebService\Client
     */
    public function setTaxConfigRef($TaxConfigRef)
    {
      $this->TaxConfigRef = $TaxConfigRef;
      return $this;
    }

    /**
     * @return ArrayOfRecordRef
     */
    public function getNodes()
    {
      return $this->Nodes;
    }

    /**
     * @param ArrayOfRecordRef $Nodes
     * @return \ProgressionWebService\Client
     */
    public function setNodes($Nodes)
    {
      $this->Nodes = $Nodes;
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
     * @return \ProgressionWebService\Client
     */
    public function setResources($Resources)
    {
      $this->Resources = $Resources;
      return $this;
    }

    /**
     * @return ArrayOfRecordRef
     */
    public function getHumanResources()
    {
      return $this->HumanResources;
    }

    /**
     * @param ArrayOfRecordRef $HumanResources
     * @return \ProgressionWebService\Client
     */
    public function setHumanResources($HumanResources)
    {
      $this->HumanResources = $HumanResources;
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
     * @return \ProgressionWebService\Client
     */
    public function setAddress($Address)
    {
      $this->Address = $Address;
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
     * @return \ProgressionWebService\Client
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
     * @return \ProgressionWebService\Client
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
     * @return \ProgressionWebService\Client
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
     * @return \ProgressionWebService\Client
     */
    public function setLabel($Label)
    {
      $this->Label = $Label;
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
     * @return \ProgressionWebService\Client
     */
    public function setLang($Lang)
    {
      $this->Lang = $Lang;
      return $this;
    }

}
