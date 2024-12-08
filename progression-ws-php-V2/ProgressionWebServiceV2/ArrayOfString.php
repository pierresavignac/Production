<?php

namespace ProgressionWebService;

class ArrayOfString
{

    /**
     * @var string[] $Value
     */
    protected $Value = null;

    
    public function __construct()
    {
    
    }

    /**
     * @return string[]
     */
    public function getValue()
    {
      return $this->Value;
    }

    /**
     * @param string[] $Value
     * @return \ProgressionWebService\ArrayOfString
     */
    public function setValue(array $Value = null)
    {
      $this->Value = $Value;
      return $this;
    }

}
