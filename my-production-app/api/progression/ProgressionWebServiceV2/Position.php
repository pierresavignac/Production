<?php

namespace ProgressionWebService;

class Position
{

    /**
     * @var float $Latitude
     */
    protected $Latitude = null;

    /**
     * @var float $Longitude
     */
    protected $Longitude = null;

    /**
     * @param float $Latitude
     * @param float $Longitude
     */
    public function __construct($Latitude = null, $Longitude = null)
    {
      $this->Latitude = $Latitude;
      $this->Longitude = $Longitude;
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
     * @return \ProgressionWebService\Position
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
     * @return \ProgressionWebService\Position
     */
    public function setLongitude($Longitude)
    {
      $this->Longitude = $Longitude;
      return $this;
    }

}
