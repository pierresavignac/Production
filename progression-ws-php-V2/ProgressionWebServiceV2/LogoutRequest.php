<?php

namespace ProgressionWebService;

class LogoutRequest
{

    /**
     * @var Credentials $credentials
     */
    protected $credentials = null;

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
     * @return \ProgressionWebService\LogoutRequest
     */
    public function setCredentials($credentials)
    {
      $this->credentials = $credentials;
      return $this;
    }

}
