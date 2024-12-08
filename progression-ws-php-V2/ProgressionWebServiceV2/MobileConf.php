<?php

namespace ProgressionWebService;

class MobileConf extends Record
{

    /**
     * @var ArrayOfProperty $MobileSettings
     */
    protected $MobileSettings = null;

    /**
     * @var string $ConfEditPassword
     */
    protected $ConfEditPassword = null;

    /**
     * @var int $Version
     */
    protected $Version = null;

    /**
     * @param int $Id
     * @param string $UID
     * @param string $ExternalId
     * @param \DateTime $removed
     * @param anySimpleType $updated
     * @param anySimpleType $created
     * @param string $ConfEditPassword
     * @param int $Version
     */
    public function __construct($Id = null, $UID = null, $ExternalId = null, \DateTime $removed = null, $updated = null, $created = null, $ConfEditPassword = null, $Version = null)
    {
      parent::__construct($Id, $UID, $ExternalId, $removed, $updated, $created);
      $this->ConfEditPassword = $ConfEditPassword;
      $this->Version = $Version;
    }

    /**
     * @return ArrayOfProperty
     */
    public function getMobileSettings()
    {
      return $this->MobileSettings;
    }

    /**
     * @param ArrayOfProperty $MobileSettings
     * @return \ProgressionWebService\MobileConf
     */
    public function setMobileSettings($MobileSettings)
    {
      $this->MobileSettings = $MobileSettings;
      return $this;
    }

    /**
     * @return string
     */
    public function getConfEditPassword()
    {
      return $this->ConfEditPassword;
    }

    /**
     * @param string $ConfEditPassword
     * @return \ProgressionWebService\MobileConf
     */
    public function setConfEditPassword($ConfEditPassword)
    {
      $this->ConfEditPassword = $ConfEditPassword;
      return $this;
    }

    /**
     * @return int
     */
    public function getVersion()
    {
      return $this->Version;
    }

    /**
     * @param int $Version
     * @return \ProgressionWebService\MobileConf
     */
    public function setVersion($Version)
    {
      $this->Version = $Version;
      return $this;
    }

}
