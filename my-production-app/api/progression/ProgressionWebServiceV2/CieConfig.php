<?php

namespace ProgressionWebService;

class CieConfig
{

    /**
     * @var CieConfigKey $CieConfigKey
     */
    protected $CieConfigKey = null;

    /**
     * @var string $Value
     */
    protected $Value = null;

    /**
     * @var string $Name
     */
    protected $Name = null;

    /**
     * @param string $Value
     * @param string $Name
     */
    public function __construct($Value = null, $Name = null)
    {
      $this->Value = $Value;
      $this->Name = $Name;
    }

    /**
     * @return CieConfigKey
     */
    public function getCieConfigKey()
    {
      return $this->CieConfigKey;
    }

    /**
     * @param CieConfigKey $CieConfigKey
     * @return \ProgressionWebService\CieConfig
     */
    public function setCieConfigKey($CieConfigKey)
    {
      $this->CieConfigKey = $CieConfigKey;
      return $this;
    }

    /**
     * @return string
     */
    public function getValue()
    {
      return $this->Value;
    }

    /**
     * @param string $Value
     * @return \ProgressionWebService\CieConfig
     */
    public function setValue($Value)
    {
      $this->Value = $Value;
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
     * @return \ProgressionWebService\CieConfig
     */
    public function setName($Name)
    {
      $this->Name = $Name;
      return $this;
    }

}
