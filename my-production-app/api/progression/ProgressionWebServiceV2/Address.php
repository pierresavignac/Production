<?php

namespace ProgressionWebService;

class Address
{

    /**
     * @var string $Address
     */
    protected $Address = null;

    /**
     * @var string $App
     */
    protected $App = null;

    /**
     * @var string $City
     */
    protected $City = null;

    /**
     * @var string $Province
     */
    protected $Province = null;

    /**
     * @var string $Country
     */
    protected $Country = null;

    /**
     * @var string $PostalCode
     */
    protected $PostalCode = null;

    /**
     * @var Position $Position
     */
    protected $Position = null;

    /**
     * @var string $Phone
     */
    protected $Phone = null;

    /**
     * @var string $Fax
     */
    protected $Fax = null;

    /**
     * @var string $Email
     */
    protected $Email = null;

    /**
     * @param string $Address
     * @param string $City
     * @param string $Province
     * @param string $Country
     * @param string $PostalCode
     */
    public function __construct($Address = null, $City = null, $Province = null, $Country = null, $PostalCode = null)
    {
      $this->Address = $Address;
      $this->City = $City;
      $this->Province = $Province;
      $this->Country = $Country;
      $this->PostalCode = $PostalCode;
    }

    /**
     * @return string
     */
    public function getAddress()
    {
      return $this->Address;
    }

    /**
     * @param string $Address
     * @return \ProgressionWebService\Address
     */
    public function setAddress($Address)
    {
      $this->Address = $Address;
      return $this;
    }

    /**
     * @return string
     */
    public function getApp()
    {
      return $this->App;
    }

    /**
     * @param string $App
     * @return \ProgressionWebService\Address
     */
    public function setApp($App)
    {
      $this->App = $App;
      return $this;
    }

    /**
     * @return string
     */
    public function getCity()
    {
      return $this->City;
    }

    /**
     * @param string $City
     * @return \ProgressionWebService\Address
     */
    public function setCity($City)
    {
      $this->City = $City;
      return $this;
    }

    /**
     * @return string
     */
    public function getProvince()
    {
      return $this->Province;
    }

    /**
     * @param string $Province
     * @return \ProgressionWebService\Address
     */
    public function setProvince($Province)
    {
      $this->Province = $Province;
      return $this;
    }

    /**
     * @return string
     */
    public function getCountry()
    {
      return $this->Country;
    }

    /**
     * @param string $Country
     * @return \ProgressionWebService\Address
     */
    public function setCountry($Country)
    {
      $this->Country = $Country;
      return $this;
    }

    /**
     * @return string
     */
    public function getPostalCode()
    {
      return $this->PostalCode;
    }

    /**
     * @param string $PostalCode
     * @return \ProgressionWebService\Address
     */
    public function setPostalCode($PostalCode)
    {
      $this->PostalCode = $PostalCode;
      return $this;
    }

    /**
     * @return Position
     */
    public function getPosition()
    {
      return $this->Position;
    }

    /**
     * @param Position $Position
     * @return \ProgressionWebService\Address
     */
    public function setPosition($Position)
    {
      $this->Position = $Position;
      return $this;
    }

    /**
     * @return string
     */
    public function getPhone()
    {
      return $this->Phone;
    }

    /**
     * @param string $Phone
     * @return \ProgressionWebService\Address
     */
    public function setPhone($Phone)
    {
      $this->Phone = $Phone;
      return $this;
    }

    /**
     * @return string
     */
    public function getFax()
    {
      return $this->Fax;
    }

    /**
     * @param string $Fax
     * @return \ProgressionWebService\Address
     */
    public function setFax($Fax)
    {
      $this->Fax = $Fax;
      return $this;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
      return $this->Email;
    }

    /**
     * @param string $Email
     * @return \ProgressionWebService\Address
     */
    public function setEmail($Email)
    {
      $this->Email = $Email;
      return $this;
    }

}
