<?php

namespace ProgressionWebService;

class FileData extends Record
{

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
     * @param string $Name
     * @param string $ContentType
     * @param int $Size
     * @param base64Binary $Data
     */
    public function __construct($Id = null, $UID = null, $ExternalId = null, \DateTime $removed = null, $updated = null, $created = null, $Name = null, $ContentType = null, $Size = null, $Data = null)
    {
      parent::__construct($Id, $UID, $ExternalId, $removed, $updated, $created);
      $this->Name = $Name;
      $this->ContentType = $ContentType;
      $this->Size = $Size;
      $this->Data = $Data;
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
     * @return \ProgressionWebService\FileData
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
     * @return \ProgressionWebService\FileData
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
     * @return \ProgressionWebService\FileData
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
     * @return \ProgressionWebService\FileData
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
     * @return \ProgressionWebService\FileData
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
     * @return \ProgressionWebService\FileData
     */
    public function setData($Data)
    {
      $this->Data = $Data;
      return $this;
    }

}
