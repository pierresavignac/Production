<?php

namespace ProgressionWebService;

class EchoRequest
{

    /**
     * @var Credentials $credentials
     */
    protected $credentials = null;

    /**
     * @var string $inputString
     */
    protected $inputString = null;

    /**
     * @param Credentials $credentials
     */
    public function __construct($credentials = null)
    {
      $this->credentials = $credentials;
    }

    /**
     * @return Credentials
     */
    public function getCredentials()
    {
      return $this->credentials;
    }

    /**
     * @param Credentials $credentials
     * @return \ProgressionWebService\EchoRequest
     */
    public function setCredentials($credentials)
    {
      $this->credentials = $credentials;
      return $this;
    }

    /**
     * @return string
     */
    public function getInputString()
    {
      return $this->inputString;
    }

    /**
     * @param string $inputString
     * @return \ProgressionWebService\EchoRequest
     */
    public function setInputString($inputString)
    {
      $this->inputString = $inputString;
      return $this;
    }

}
