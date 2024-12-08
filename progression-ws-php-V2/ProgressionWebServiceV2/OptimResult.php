<?php

namespace ProgressionWebService;

class OptimResult extends Record
{

    /**
     * @var RecordRef $HumanResourceRef
     */
    protected $HumanResourceRef = null;

    /**
     * @var \DateTime $Appointment
     */
    protected $Appointment = null;

    /**
     * @var float $ActivityCost
     */
    protected $ActivityCost = null;

    /**
     * @var float $TransportCost
     */
    protected $TransportCost = null;

    /**
     * @var float $TransportDistanceInKm
     */
    protected $TransportDistanceInKm = null;

    /**
     * @var int $TransportDurationInMillis
     */
    protected $TransportDurationInMillis = null;

    /**
     * @param int $Id
     * @param string $UID
     * @param string $ExternalId
     * @param \DateTime $removed
     * @param anySimpleType $updated
     * @param anySimpleType $created
     * @param \DateTime $Appointment
     * @param float $ActivityCost
     * @param float $TransportCost
     * @param float $TransportDistanceInKm
     * @param int $TransportDurationInMillis
     */
    public function __construct($Id = null, $UID = null, $ExternalId = null, \DateTime $removed = null, $updated = null, $created = null, \DateTime $Appointment = null, $ActivityCost = null, $TransportCost = null, $TransportDistanceInKm = null, $TransportDurationInMillis = null)
    {
      parent::__construct($Id, $UID, $ExternalId, $removed, $updated, $created);
      $this->Appointment = $Appointment ? $Appointment->format(\DateTime::ATOM) : null;
      $this->ActivityCost = $ActivityCost;
      $this->TransportCost = $TransportCost;
      $this->TransportDistanceInKm = $TransportDistanceInKm;
      $this->TransportDurationInMillis = $TransportDurationInMillis;
    }

    /**
     * @return RecordRef
     */
    public function getHumanResourceRef()
    {
      return $this->HumanResourceRef;
    }

    /**
     * @param RecordRef $HumanResourceRef
     * @return \ProgressionWebService\OptimResult
     */
    public function setHumanResourceRef($HumanResourceRef)
    {
      $this->HumanResourceRef = $HumanResourceRef;
      return $this;
    }

    /**
     * @return \DateTime
     */
    public function getAppointment()
    {
      if ($this->Appointment == null) {
        return null;
      } else {
        try {
          return new \DateTime($this->Appointment);
        } catch (\Exception $e) {
          return false;
        }
      }
    }

    /**
     * @param \DateTime $Appointment
     * @return \ProgressionWebService\OptimResult
     */
    public function setAppointment(\DateTime $Appointment)
    {
      $this->Appointment = $Appointment->format(\DateTime::ATOM);
      return $this;
    }

    /**
     * @return float
     */
    public function getActivityCost()
    {
      return $this->ActivityCost;
    }

    /**
     * @param float $ActivityCost
     * @return \ProgressionWebService\OptimResult
     */
    public function setActivityCost($ActivityCost)
    {
      $this->ActivityCost = $ActivityCost;
      return $this;
    }

    /**
     * @return float
     */
    public function getTransportCost()
    {
      return $this->TransportCost;
    }

    /**
     * @param float $TransportCost
     * @return \ProgressionWebService\OptimResult
     */
    public function setTransportCost($TransportCost)
    {
      $this->TransportCost = $TransportCost;
      return $this;
    }

    /**
     * @return float
     */
    public function getTransportDistanceInKm()
    {
      return $this->TransportDistanceInKm;
    }

    /**
     * @param float $TransportDistanceInKm
     * @return \ProgressionWebService\OptimResult
     */
    public function setTransportDistanceInKm($TransportDistanceInKm)
    {
      $this->TransportDistanceInKm = $TransportDistanceInKm;
      return $this;
    }

    /**
     * @return int
     */
    public function getTransportDurationInMillis()
    {
      return $this->TransportDurationInMillis;
    }

    /**
     * @param int $TransportDurationInMillis
     * @return \ProgressionWebService\OptimResult
     */
    public function setTransportDurationInMillis($TransportDurationInMillis)
    {
      $this->TransportDurationInMillis = $TransportDurationInMillis;
      return $this;
    }

}
