<?php

namespace ProgressionWebService;

class UpdateDisponibilityRequest
{

    /**
     * @var Credentials $credentials
     */
    protected $credentials = null;

    /**
     * @var RecordRef $disponibilityRef
     */
    protected $disponibilityRef = null;

    /**
     * @var \DateTime $timestamp
     */
    protected $timestamp = null;

    /**
     * @param Credentials $credentials
     * @param RecordRef $disponibilityRef
     */
    public function __construct($credentials = null, $disponibilityRef = null)
    {
      $this->credentials = $credentials;
      $this->disponibilityRef = $disponibilityRef;
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
     * @return \ProgressionWebService\UpdateDisponibilityRequest
     */
    public function setCredentials($credentials)
    {
      $this->credentials = $credentials;
      return $this;
    }

    /**
     * @return RecordRef
     */
    public function getDisponibilityRef()
    {
      return $this->disponibilityRef;
    }

    /**
     * @param RecordRef $disponibilityRef
     * @return \ProgressionWebService\UpdateDisponibilityRequest
     */
    public function setDisponibilityRef($disponibilityRef)
    {
      $this->disponibilityRef = $disponibilityRef;
      return $this;
    }

    /**
     * @return \DateTime
     */
    public function getTimestamp()
    {
      if ($this->timestamp == null) {
        return null;
      } else {
        try {
          return new \DateTime($this->timestamp);
        } catch (\Exception $e) {
          return false;
        }
      }
    }

    /**
     * @param \DateTime $timestamp
     * @return \ProgressionWebService\UpdateDisponibilityRequest
     */
    public function setTimestamp(\DateTime $timestamp = null)
    {
      if ($timestamp == null) {
       $this->timestamp = null;
      } else {
        $this->timestamp = $timestamp->format(\DateTime::ATOM);
      }
      return $this;
    }

}
