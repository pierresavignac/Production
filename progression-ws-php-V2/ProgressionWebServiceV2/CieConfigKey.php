<?php

namespace ProgressionWebService;

class CieConfigKey
{

    /**
     * @var string $Key
     */
    protected $Key = null;

    /**
     * @var string $DefaultValue
     */
    protected $DefaultValue = null;

    /**
     * @var string $Widget
     */
    protected $Widget = null;

    /**
     * @param string $Key
     * @param string $DefaultValue
     * @param string $Widget
     */
    public function __construct($Key = null, $DefaultValue = null, $Widget = null)
    {
      $this->Key = $Key;
      $this->DefaultValue = $DefaultValue;
      $this->Widget = $Widget;
    }

    /**
     * @return string
     */
    public function getKey()
    {
      return $this->Key;
    }

    /**
     * @param string $Key
     * @return \ProgressionWebService\CieConfigKey
     */
    public function setKey($Key)
    {
      $this->Key = $Key;
      return $this;
    }

    /**
     * @return string
     */
    public function getDefaultValue()
    {
      return $this->DefaultValue;
    }

    /**
     * @param string $DefaultValue
     * @return \ProgressionWebService\CieConfigKey
     */
    public function setDefaultValue($DefaultValue)
    {
      $this->DefaultValue = $DefaultValue;
      return $this;
    }

    /**
     * @return string
     */
    public function getWidget()
    {
      return $this->Widget;
    }

    /**
     * @param string $Widget
     * @return \ProgressionWebService\CieConfigKey
     */
    public function setWidget($Widget)
    {
      $this->Widget = $Widget;
      return $this;
    }

}
