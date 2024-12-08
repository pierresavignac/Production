<?php

namespace ProgressionWebService;

class ChangePasswordRequest
{

    /**
     * @var Credentials $credentials
     */
    protected $credentials = null;

    /**
     * @var string $newPassword
     */
    protected $newPassword = null;

    /**
     * @param Credentials $credentials
     * @param string $newPassword
     */
    public function __construct($credentials = null, $newPassword = null)
    {
      $this->credentials = $credentials;
      $this->newPassword = $newPassword;
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
     * @return \ProgressionWebService\ChangePasswordRequest
     */
    public function setCredentials($credentials)
    {
      $this->credentials = $credentials;
      return $this;
    }

    /**
     * @return string
     */
    public function getNewPassword()
    {
      return $this->newPassword;
    }

    /**
     * @param string $newPassword
     * @return \ProgressionWebService\ChangePasswordRequest
     */
    public function setNewPassword($newPassword)
    {
      $this->newPassword = $newPassword;
      return $this;
    }

}
