<?php

namespace ProgressionWebService;

class Profile
{

    /**
     * @var Role $Role
     */
    protected $Role = null;

    /**
     * @var MobileConf $MobileConf
     */
    protected $MobileConf = null;

    /**
     * @var Cie $Cie
     */
    protected $Cie = null;

    /**
     * @var HumanResource $HumanResource
     */
    protected $HumanResource = null;

    /**
     * @var RecordRef $UserRef
     */
    protected $UserRef = null;

    /**
     * @var string $Language
     */
    protected $Language = null;

    /**
     * @param Role $Role
     * @param string $Language
     */
    public function __construct($Role = null, $Language = null)
    {
      $this->Role = $Role;
      $this->Language = $Language;
    }

    /**
     * @return Role
     */
    public function getRole()
    {
      return $this->Role;
    }

    /**
     * @param Role $Role
     * @return \ProgressionWebService\Profile
     */
    public function setRole($Role)
    {
      $this->Role = $Role;
      return $this;
    }

    /**
     * @return MobileConf
     */
    public function getMobileConf()
    {
      return $this->MobileConf;
    }

    /**
     * @param MobileConf $MobileConf
     * @return \ProgressionWebService\Profile
     */
    public function setMobileConf($MobileConf)
    {
      $this->MobileConf = $MobileConf;
      return $this;
    }

    /**
     * @return Cie
     */
    public function getCie()
    {
      return $this->Cie;
    }

    /**
     * @param Cie $Cie
     * @return \ProgressionWebService\Profile
     */
    public function setCie($Cie)
    {
      $this->Cie = $Cie;
      return $this;
    }

    /**
     * @return HumanResource
     */
    public function getHumanResource()
    {
      return $this->HumanResource;
    }

    /**
     * @param HumanResource $HumanResource
     * @return \ProgressionWebService\Profile
     */
    public function setHumanResource($HumanResource)
    {
      $this->HumanResource = $HumanResource;
      return $this;
    }

    /**
     * @return RecordRef
     */
    public function getUserRef()
    {
      return $this->UserRef;
    }

    /**
     * @param RecordRef $UserRef
     * @return \ProgressionWebService\Profile
     */
    public function setUserRef($UserRef)
    {
      $this->UserRef = $UserRef;
      return $this;
    }

    /**
     * @return string
     */
    public function getLanguage()
    {
      return $this->Language;
    }

    /**
     * @param string $Language
     * @return \ProgressionWebService\Profile
     */
    public function setLanguage($Language)
    {
      $this->Language = $Language;
      return $this;
    }

}
