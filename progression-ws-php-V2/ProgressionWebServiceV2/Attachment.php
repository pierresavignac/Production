<?php

namespace ProgressionWebService;

abstract class Attachment extends Record
{

    /**
     * @var RecordRef $TypeRef
     */
    protected $TypeRef = null;

    /**
     * @var string $Title
     */
    protected $Title = null;

    /**
     * @var string $Description
     */
    protected $Description = null;

    /**
     * @var string $Name
     */
    protected $Name = null;

    /**
     * @var string $ContentType
     */
    protected $ContentType = null;

    /**
     * @var int $Size
     */
    protected $Size = null;

    /**
     * @var base64Binary $Data
     */
    protected $Data = null;

    /**
     * @param int $Id
     * @param string $UID
     * @param string $ExternalId
     * @param \DateTime $removed
     * @param anySimpleType $updated
     * @param anySimpleType $created
     * @param RecordRef $TypeRef
     * @param string $Name
     * @param int $Size
     */
    public function __construct($Id = null, $UID = null, $ExternalId = null, \DateTime $removed = null, $updated = null, $created = null, $TypeRef = null, $Name = null, $Size = null)
    {
      parent::__construct($Id, $UID, $ExternalId, $removed, $updated, $created);
      $this->TypeRef = $TypeRef;
      $this->Name = $Name;
      $this->Size = $Size;
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
     * @return \ProgressionWebService\Attachment
     */
    public function setTypeRef($TypeRef)
    {
      $this->TypeRef = $TypeRef;
      return $this;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
      return $this->Title;
    }

    /**
     * @param string $Title
     * @return \ProgressionWebService\Attachment
     */
    public function setTitle($Title)
    {
      $this->Title = $Title;
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
     * @return \ProgressionWebService\Attachment
     */
    public function setDescription($Description)
    {
      $this->Description = $Description;
      return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
      return $this->Name;
    }

    /**
     * @param string $Name
     * @return \ProgressionWebService\Attachment
     */
    public function setName($Name)
    {
      $this->Name = $Name;
      return $this;
    }

    /**
     * @return string
     */
    public function getContentType()
    {
      return $this->ContentType;
    }

    /**
     * @param string $ContentType
     * @return \ProgressionWebService\Attachment
     */
    public function setContentType($ContentType)
    {
      $this->ContentType = $ContentType;
      return $this;
    }

    /**
     * @return int
     */
    public function getSize()
    {
      return $this->Size;
    }

    /**
     * @param int $Size
     * @return \ProgressionWebService\Attachment
     */
    public function setSize($Size)
    {
      $this->Size = $Size;
      return $this;
    }

    /**
     * @return base64Binary
     */
    public function getData()
    {
      return $this->Data;
    }

    /**
     * @param base64Binary $Data
     * @return \ProgressionWebService\Attachment
     */
    public function setData($Data)
    {
      $this->Data = $Data;
      return $this;
    }

}
