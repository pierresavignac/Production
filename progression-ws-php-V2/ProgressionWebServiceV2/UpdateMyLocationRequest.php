<?php

namespace ProgressionWebService;

class UpdateMyLocationRequest
{

    /**
     * @var Credentials $credentials
     */
    protected $credentials = null;

    /**
     * @var Location $location
     */
    protected $location = null;

    /**
     * @param Credentials $credentials
     * @param Location $location
     */
    public function __construct($credentials = null, $location = null)
    {
      $this->credentials = $credentials;
      $this->location = $location;
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
     * @return \ProgressionWebService\UpdateMyLocationRequest
     */
    public function setCredentials($credentials)
    {
      $this->credentials = $credentials;
      return $this;
    }

    /**
     * @return Location
     */
    public function getLocation()
    {
      return $this->location;
    }

    /**
     * @param Location $location
     * @return \ProgressionWebService\UpdateMyLocationRequest
     */
    public function setLocation($location)
    {
      $this->location = $location;
      return $this;
    }

}
