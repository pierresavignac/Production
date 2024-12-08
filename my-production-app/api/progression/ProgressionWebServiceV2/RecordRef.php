<?php

namespace ProgressionWebService;

class RecordRef
{

    /**
     * @var int $Id
     */
    protected $Id = null;

    /**
     * @var RecordType $Type
     */
    protected $Type = null;

    /**
     * @var string $UID
     */
    protected $UID = null;

    /**
     * @var string $ExternalId
     */
    protected $ExternalId = null;

    /**
     * @var string $Label
     */
    protected $Label = null;

    /**
     * @param int $Id
     * @param RecordType $Type
     * @param string $UID
     * @param string $ExternalId
     * @param string $Label
     */
    public function __construct($Id = null, $Type = null, $UID = null, $ExternalId = null, $Label = null)
    {
      $this->Id = $Id;
      $this->Type = $Type;
      $this->UID = $UID;
      $this->ExternalId = $ExternalId;
      $this->Label = $Label;
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
     * @return \ProgressionWebService\RecordRef
     */
    public function setId($Id)
    {
      $this->Id = $Id;
      return $this;
    }

    /**
     * @return RecordType
     */
    public function getType()
    {
      return $this->Type;
    }

    /**
     * @param RecordType $Type
     * @return \ProgressionWebService\RecordRef
     */
    public function setType($Type)
    {
      $this->Type = $Type;
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
     * @return \ProgressionWebService\RecordRef
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
     * @return \ProgressionWebService\RecordRef
     */
    public function setExternalId($ExternalId)
    {
      $this->ExternalId = $ExternalId;
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
     * @return \ProgressionWebService\RecordRef
     */
    public function setLabel($Label)
    {
      $this->Label = $Label;
      return $this;
    }

}
