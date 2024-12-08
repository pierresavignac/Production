<?php

namespace ProgressionWebService;

class Credentials
{

    /**
     * @var string $SessionID
     */
    protected $SessionID = null;

    /**
     * @var string $DeviceID
     */
    protected $DeviceID = null;

    /**
     * @var string $ClientVersion
     */
    protected $ClientVersion = null;

    /**
     * @var string $Username
     */
    protected $Username = null;

    /**
     * @var string $Password
     */
    protected $Password = null;

    /**
     * @param string $SessionID
     * @param string $DeviceID
     * @param string $ClientVersion
     * @param string $Username
     * @param string $Password
     */
    public function __construct($SessionID = null, $DeviceID = null, $ClientVersion = null, $Username = null, $Password = null)
    {
      $this->SessionID = $SessionID;
      $this->DeviceID = $DeviceID;
      $this->ClientVersion = $ClientVersion;
      $this->Username = $Username;
      $this->Password = $Password;
    }

    /**
     * @return string
     */
    public function getSessionID()
    {
      return $this->SessionID;
    }

    /**
     * @param string $SessionID
     * @return \ProgressionWebService\Credentials
     */
    public function setSessionID($SessionID)
    {
      $this->SessionID = $SessionID;
      return $this;
    }

    /**
     * @return string
     */
    public function getDeviceID()
    {
      return $this->DeviceID;
    }

    /**
     * @param string $DeviceID
     * @return \ProgressionWebService\Credentials
     */
    public function setDeviceID($DeviceID)
    {
      $this->DeviceID = $DeviceID;
      return $this;
    }

    /**
     * @return string
     */
    public function getClientVersion()
    {
      return $this->ClientVersion;
    }

    /**
     * @param string $ClientVersion
     * @return \ProgressionWebService\Credentials
     */
    public function setClientVersion($ClientVersion)
    {
      $this->ClientVersion = $ClientVersion;
      return $this;
    }

    /**
     * @return string
     */
    public function getUsername()
    {
      return $this->Username;
    }

    /**
     * @param string $Username
     * @return \ProgressionWebService\Credentials
     */
    public function setUsername($Username)
    {
      $this->Username = $Username;
      return $this;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
      return $this->Password;
    }

    /**
     * @param string $Password
     * @return \ProgressionWebService\Credentials
     */
    public function setPassword($Password)
    {
      $this->Password = $Password;
      return $this;
    }

}
