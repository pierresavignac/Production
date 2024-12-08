<?php

namespace ProgressionWebService;

class ArrayOfInt
{

    /**
     * @var int[] $Value
     */
    protected $Value = null;

    
    public function __construct()
    {
    
    }

    /**
     * @return int[]
     */
    public function getValue()
    {
      return $this->Value;
    }

    /**
     * @param int[] $Value
     * @return \ProgressionWebService\ArrayOfInt
     */
    public function setValue(array $Value = null)
    {
      $this->Value = $Value;
      return $this;
    }

}
