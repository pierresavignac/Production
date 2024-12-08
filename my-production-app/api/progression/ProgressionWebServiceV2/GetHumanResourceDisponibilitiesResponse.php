<?php

namespace ProgressionWebService;

class GetHumanResourceDisponibilitiesResponse
{

    /**
     * @var HumanResourceDisponibility $HumanResourceDisponibilities
     */
    protected $HumanResourceDisponibilities = null;

    /**
     * @param HumanResourceDisponibility $HumanResourceDisponibilities
     */
    public function __construct($HumanResourceDisponibilities = null)
    {
      $this->HumanResourceDisponibilities = $HumanResourceDisponibilities;
    }

    /**
     * @return HumanResourceDisponibility
     */
    public function getHumanResourceDisponibilities()
    {
      return $this->HumanResourceDisponibilities;
    }

    /**
     * @param HumanResourceDisponibility $HumanResourceDisponibilities
     * @return \ProgressionWebService\GetHumanResourceDisponibilitiesResponse
     */
    public function setHumanResourceDisponibilities($HumanResourceDisponibilities)
    {
      $this->HumanResourceDisponibilities = $HumanResourceDisponibilities;
      return $this;
    }

}
