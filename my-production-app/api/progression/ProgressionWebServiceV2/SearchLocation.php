<?php

namespace ProgressionWebService;

class SearchLocation
{

    /**
     * @var Position $Position
     */
    protected $Position = null;

    /**
     * @var int $RadiusInMetres
     */
    protected $RadiusInMetres = null;

    /**
     * @param Position $Position
     * @param int $RadiusInMetres
     */
    public function __construct($Position = null, $RadiusInMetres = null)
    {
      $this->Position = $Position;
      $this->RadiusInMetres = $RadiusInMetres;
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
     * @return \ProgressionWebService\SearchLocation
     */
    public function setPosition($Position)
    {
      $this->Position = $Position;
      return $this;
    }

    /**
     * @return int
     */
    public function getRadiusInMetres()
    {
      return $this->RadiusInMetres;
    }

    /**
     * @param int $RadiusInMetres
     * @return \ProgressionWebService\SearchLocation
     */
    public function setRadiusInMetres($RadiusInMetres)
    {
      $this->RadiusInMetres = $RadiusInMetres;
      return $this;
    }

}
