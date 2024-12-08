<?php

namespace ProgressionWebService;

class Property
{

    /**
     * @var anyType $Value
     */
    protected $Value = null;

    /**
     * @var string $Name
     */
    protected $Name = null;

    /**
     * @param string $Name
     */
    public function __construct($Name = null)
    {
      $this->Name = $Name;
    }

    /**
     * @return anyType
     */
    public function getValue()
    {
      return $this->Value;
    }

    /**
     * @param anyType $Value
     * @return \ProgressionWebService\Property
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
     * @return \ProgressionWebService\Property
     */
    public function setName($Name)
    {
      $this->Name = $Name;
      return $this;
    }

}
