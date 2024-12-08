<?php

namespace ProgressionWebService;

class Cie extends Record
{

    /**
     * @var ArrayOfString $Modules
     */
    protected $Modules = null;

    /**
     * @var ArrayOfCieConfig $Config
     */
    protected $Config = null;

    /**
     * @var base64Binary $Logo
     */
    protected $Logo = null;

    /**
     * @var string $Name
     */
    protected $Name = null;

    /**
     * @var string $Description
     */
    protected $Description = null;

    /**
     * @var string $Domain
     */
    protected $Domain = null;

    /**
     * @var string $PushUrl
     */
    protected $PushUrl = null;

    /**
     * @var string $BillingAddress
     */
    protected $BillingAddress = null;

    /**
     * @var boolean $UseSpecificField
     */
    protected $UseSpecificField = null;

    /**
     * @param int $Id
     * @param string $UID
     * @param string $ExternalId
     * @param \DateTime $removed
     * @param anySimpleType $updated
     * @param anySimpleType $created
     * @param ArrayOfCieConfig $Config
     * @param string $Name
     * @param string $Description
     * @param string $Domain
     * @param string $PushUrl
     * @param string $BillingAddress
     * @param boolean $UseSpecificField
     */
    public function __construct($Id = null, $UID = null, $ExternalId = null, \DateTime $removed = null, $updated = null, $created = null, $Config = null, $Name = null, $Description = null, $Domain = null, $PushUrl = null, $BillingAddress = null, $UseSpecificField = null)
    {
      parent::__construct($Id, $UID, $ExternalId, $removed, $updated, $created);
      $this->Config = $Config;
      $this->Name = $Name;
      $this->Description = $Description;
      $this->Domain = $Domain;
      $this->PushUrl = $PushUrl;
      $this->BillingAddress = $BillingAddress;
      $this->UseSpecificField = $UseSpecificField;
    }

    /**
     * @return ArrayOfString
     */
    public function getModules()
    {
      return $this->Modules;
    }

    /**
     * @param ArrayOfString $Modules
     * @return \ProgressionWebService\Cie
     */
    public function setModules($Modules)
    {
      $this->Modules = $Modules;
      return $this;
    }

    /**
     * @return ArrayOfCieConfig
     */
    public function getConfig()
    {
      return $this->Config;
    }

    /**
     * @param ArrayOfCieConfig $Config
     * @return \ProgressionWebService\Cie
     */
    public function setConfig($Config)
    {
      $this->Config = $Config;
      return $this;
    }

    /**
     * @return base64Binary
     */
    public function getLogo()
    {
      return $this->Logo;
    }

    /**
     * @param base64Binary $Logo
     * @return \ProgressionWebService\Cie
     */
    public function setLogo($Logo)
    {
      $this->Logo = $Logo;
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
     * @return \ProgressionWebService\Cie
     */
    public function setName($Name)
    {
      $this->Name = $Name;
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
     * @return \ProgressionWebService\Cie
     */
    public function setDescription($Description)
    {
      $this->Description = $Description;
      return $this;
    }

    /**
     * @return string
     */
    public function getDomain()
    {
      return $this->Domain;
    }

    /**
     * @param string $Domain
     * @return \ProgressionWebService\Cie
     */
    public function setDomain($Domain)
    {
      $this->Domain = $Domain;
      return $this;
    }

    /**
     * @return string
     */
    public function getPushUrl()
    {
      return $this->PushUrl;
    }

    /**
     * @param string $PushUrl
     * @return \ProgressionWebService\Cie
     */
    public function setPushUrl($PushUrl)
    {
      $this->PushUrl = $PushUrl;
      return $this;
    }

    /**
     * @return string
     */
    public function getBillingAddress()
    {
      return $this->BillingAddress;
    }

    /**
     * @param string $BillingAddress
     * @return \ProgressionWebService\Cie
     */
    public function setBillingAddress($BillingAddress)
    {
      $this->BillingAddress = $BillingAddress;
      return $this;
    }

    /**
     * @return boolean
     */
    public function getUseSpecificField()
    {
      return $this->UseSpecificField;
    }

    /**
     * @param boolean $UseSpecificField
     * @return \ProgressionWebService\Cie
     */
    public function setUseSpecificField($UseSpecificField)
    {
      $this->UseSpecificField = $UseSpecificField;
      return $this;
    }

}
