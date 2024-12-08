<?php

namespace ProgressionWebService;

class GetHumanResourceDisponibilitiesRequest
{

    /**
     * @var Credentials $credentials
     */
    protected $credentials = null;

    /**
     * @var string $query
     */
    protected $query = null;

    /**
     * @var ArrayOfProperty $parameters
     */
    protected $parameters = null;

    /**
     * @var \DateTime $dateTimeFrom
     */
    protected $dateTimeFrom = null;

    /**
     * @var \DateTime $dateTimeTo
     */
    protected $dateTimeTo = null;

    /**
     * @param Credentials $credentials
     * @param string $query
     * @param ArrayOfProperty $parameters
     * @param \DateTime $dateTimeFrom
     * @param \DateTime $dateTimeTo
     */
    public function __construct($credentials = null, $query = null, $parameters = null, \DateTime $dateTimeFrom = null, \DateTime $dateTimeTo = null)
    {
      $this->credentials = $credentials;
      $this->query = $query;
      $this->parameters = $parameters;
      $this->dateTimeFrom = $dateTimeFrom ? $dateTimeFrom->format(\DateTime::ATOM) : null;
      $this->dateTimeTo = $dateTimeTo ? $dateTimeTo->format(\DateTime::ATOM) : null;
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
     * @return \ProgressionWebService\GetHumanResourceDisponibilitiesRequest
     */
    public function setCredentials($credentials)
    {
      $this->credentials = $credentials;
      return $this;
    }

    /**
     * @return string
     */
    public function getQuery()
    {
      return $this->query;
    }

    /**
     * @param string $query
     * @return \ProgressionWebService\GetHumanResourceDisponibilitiesRequest
     */
    public function setQuery($query)
    {
      $this->query = $query;
      return $this;
    }

    /**
     * @return ArrayOfProperty
     */
    public function getParameters()
    {
      return $this->parameters;
    }

    /**
     * @param ArrayOfProperty $parameters
     * @return \ProgressionWebService\GetHumanResourceDisponibilitiesRequest
     */
    public function setParameters($parameters)
    {
      $this->parameters = $parameters;
      return $this;
    }

    /**
     * @return \DateTime
     */
    public function getDateTimeFrom()
    {
      if ($this->dateTimeFrom == null) {
        return null;
      } else {
        try {
          return new \DateTime($this->dateTimeFrom);
        } catch (\Exception $e) {
          return false;
        }
      }
    }

    /**
     * @param \DateTime $dateTimeFrom
     * @return \ProgressionWebService\GetHumanResourceDisponibilitiesRequest
     */
    public function setDateTimeFrom(\DateTime $dateTimeFrom)
    {
      $this->dateTimeFrom = $dateTimeFrom->format(\DateTime::ATOM);
      return $this;
    }

    /**
     * @return \DateTime
     */
    public function getDateTimeTo()
    {
      if ($this->dateTimeTo == null) {
        return null;
      } else {
        try {
          return new \DateTime($this->dateTimeTo);
        } catch (\Exception $e) {
          return false;
        }
      }
    }

    /**
     * @param \DateTime $dateTimeTo
     * @return \ProgressionWebService\GetHumanResourceDisponibilitiesRequest
     */
    public function setDateTimeTo(\DateTime $dateTimeTo)
    {
      $this->dateTimeTo = $dateTimeTo->format(\DateTime::ATOM);
      return $this;
    }

}
