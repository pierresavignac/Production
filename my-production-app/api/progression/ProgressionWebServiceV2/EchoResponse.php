<?php

namespace ProgressionWebService;

class EchoResponse
{

    /**
     * @var string $outputString
     */
    protected $outputString = null;

    
    public function __construct()
    {
    
    }

    /**
     * @return string
     */
    public function getOutputString()
    {
      return $this->outputString;
    }

    /**
     * @param string $outputString
     * @return \ProgressionWebService\EchoResponse
     */
    public function setOutputString($outputString)
    {
      $this->outputString = $outputString;
      return $this;
    }

}
