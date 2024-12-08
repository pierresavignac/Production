<?php

namespace ProgressionWebService;

class GetMyProfileRequest
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
     * @return \ProgressionWebService\GetMyProfileRequest
     */
    public function setCredentials($credentials)
    {
      $this->credentials = $credentials;
      return $this;
    }

}
