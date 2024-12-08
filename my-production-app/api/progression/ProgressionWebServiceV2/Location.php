<?php

namespace ProgressionWebService;

class Location
{

    /**
     * @var \DateTime $Datetime
     */
    protected $Datetime = null;

    /**
     * @var float $Latitude
     */
    protected $Latitude = null;

    /**
     * @var float $Longitude
     */
    protected $Longitude = null;

    /**
     * @var float $LatLonAccuracy
     */
    protected $LatLonAccuracy = null;

    /**
     * @var float $Altitude
     */
    protected $Altitude = null;

    /**
     * @var float $AltitudeUncertainty
     */
    protected $AltitudeUncertainty = null;

    /**
     * @var float $Speed
     */
    protected $Speed = null;

    /**
     * @var float $SpeedUncertainty
     */
    protected $SpeedUncertainty = null;

    /**
     * @var float $Direction
     */
    protected $Direction = null;

    /**
     * @var string $Source
     */
    protected $Source = null;

    /**
     * @param \DateTime $Datetime
     * @param float $Latitude
     * @param float $Longitude
     * @param float $LatLonAccuracy
     * @param float $Altitude
     * @param float $AltitudeUncertainty
     * @param float $Speed
     * @param float $SpeedUncertainty
     * @param float $Direction
     * @param string $Source
     */
    public function __construct(\DateTime $Datetime = null, $Latitude = null, $Longitude = null, $LatLonAccuracy = null, $Altitude = null, $AltitudeUncertainty = null, $Speed = null, $SpeedUncertainty = null, $Direction = null, $Source = null)
    {
      $this->Datetime = $Datetime ? $Datetime->format(\DateTime::ATOM) : null;
      $this->Latitude = $Latitude;
      $this->Longitude = $Longitude;
      $this->LatLonAccuracy = $LatLonAccuracy;
      $this->Altitude = $Altitude;
      $this->AltitudeUncertainty = $AltitudeUncertainty;
      $this->Speed = $Speed;
      $this->SpeedUncertainty = $SpeedUncertainty;
      $this->Direction = $Direction;
      $this->Source = $Source;
    }

    /**
     * @return \DateTime
     */
    public function getDatetime()
    {
      if ($this->Datetime == null) {
        return null;
      } else {
        try {
          return new \DateTime($this->Datetime);
        } catch (\Exception $e) {
          return false;
        }
      }
    }

    /**
     * @param \DateTime $Datetime
     * @return \ProgressionWebService\Location
     */
    public function setDatetime(\DateTime $Datetime)
    {
      $this->Datetime = $Datetime->format(\DateTime::ATOM);
      return $this;
    }

    /**
     * @return float
     */
    public function getLatitude()
    {
      return $this->Latitude;
    }

    /**
     * @param float $Latitude
     * @return \ProgressionWebService\Location
     */
    public function setLatitude($Latitude)
    {
      $this->Latitude = $Latitude;
      return $this;
    }

    /**
     * @return float
     */
    public function getLongitude()
    {
      return $this->Longitude;
    }

    /**
     * @param float $Longitude
     * @return \ProgressionWebService\Location
     */
    public function setLongitude($Longitude)
    {
      $this->Longitude = $Longitude;
      return $this;
    }

    /**
     * @return float
     */
    public function getLatLonAccuracy()
    {
      return $this->LatLonAccuracy;
    }

    /**
     * @param float $LatLonAccuracy
     * @return \ProgressionWebService\Location
     */
    public function setLatLonAccuracy($LatLonAccuracy)
    {
      $this->LatLonAccuracy = $LatLonAccuracy;
      return $this;
    }

    /**
     * @return float
     */
    public function getAltitude()
    {
      return $this->Altitude;
    }

    /**
     * @param float $Altitude
     * @return \ProgressionWebService\Location
     */
    public function setAltitude($Altitude)
    {
      $this->Altitude = $Altitude;
      return $this;
    }

    /**
     * @return float
     */
    public function getAltitudeUncertainty()
    {
      return $this->AltitudeUncertainty;
    }

    /**
     * @param float $AltitudeUncertainty
     * @return \ProgressionWebService\Location
     */
    public function setAltitudeUncertainty($AltitudeUncertainty)
    {
      $this->AltitudeUncertainty = $AltitudeUncertainty;
      return $this;
    }

    /**
     * @return float
     */
    public function getSpeed()
    {
      return $this->Speed;
    }

    /**
     * @param float $Speed
     * @return \ProgressionWebService\Location
     */
    public function setSpeed($Speed)
    {
      $this->Speed = $Speed;
      return $this;
    }

    /**
     * @return float
     */
    public function getSpeedUncertainty()
    {
      return $this->SpeedUncertainty;
    }

    /**
     * @param float $SpeedUncertainty
     * @return \ProgressionWebService\Location
     */
    public function setSpeedUncertainty($SpeedUncertainty)
    {
      $this->SpeedUncertainty = $SpeedUncertainty;
      return $this;
    }

    /**
     * @return float
     */
    public function getDirection()
    {
      return $this->Direction;
    }

    /**
     * @param float $Direction
     * @return \ProgressionWebService\Location
     */
    public function setDirection($Direction)
    {
      $this->Direction = $Direction;
      return $this;
    }

    /**
     * @return string
     */
    public function getSource()
    {
      return $this->Source;
    }

    /**
     * @param string $Source
     * @return \ProgressionWebService\Location
     */
    public function setSource($Source)
    {
      $this->Source = $Source;
      return $this;
    }

}
