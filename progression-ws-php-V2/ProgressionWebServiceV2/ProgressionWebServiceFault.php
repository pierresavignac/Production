<?php

namespace ProgressionWebService;

class ProgressionWebServiceFault
{

    /**
     * @var string $Message
     */
    protected $Message = null;

    /**
     * @var FaultType $Type
     */
    protected $Type = null;

    
    public function __construct()
    {
    
    }

    /**
     * @return string
     */
    public function getMessage()
    {
      return $this->Message;
    }

    /**
     * @param string $Message
     * @return \ProgressionWebService\ProgressionWebServiceFault
     */
    public function setMessage($Message)
    {
      $this->Message = $Message;
      return $this;
    }

    /**
     * @return FaultType
     */
    public function getType()
    {
      return $this->Type;
    }

    /**
     * @param FaultType $Type
     * @return \ProgressionWebService\ProgressionWebServiceFault
     */
    public function setType($Type)
    {
      $this->Type = $Type;
      return $this;
    }

}
