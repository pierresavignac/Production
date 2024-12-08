<?php

namespace ProgressionWebService;

class LoginResponse
{

    /**
     * @var Credentials $credentials
     */
    protected $credentials = null;

    /**
     * @var boolean $passwordExpired
     */
    protected $passwordExpired = null;

    /**
     * @param Credentials $credentials
     * @param boolean $passwordExpired
     */
    public function __construct($credentials = null, $passwordExpired = null)
    {
      $this->credentials = $credentials;
      $this->passwordExpired = $passwordExpired;
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
     * @return \ProgressionWebService\LoginResponse
     */
    public function setCredentials($credentials)
    {
      $this->credentials = $credentials;
      return $this;
    }

    /**
     * @return boolean
     */
    public function getPasswordExpired()
    {
      return $this->passwordExpired;
    }

    /**
     * @param boolean $passwordExpired
     * @return \ProgressionWebService\LoginResponse
     */
    public function setPasswordExpired($passwordExpired)
    {
      $this->passwordExpired = $passwordExpired;
      return $this;
    }

}
