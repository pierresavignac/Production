<?php

namespace ProgressionWebService;

class HumanResourceDisponibility
{

    /**
     * @var HumanResource $HumanResource
     */
    protected $HumanResource = null;

    /**
     * @var WorkingPlanWindow[] $WorkingWindows
     */
    protected $WorkingWindows = null;

    /**
     * @param HumanResource $HumanResource
     */
    public function __construct($HumanResource = null)
    {
      $this->HumanResource = $HumanResource;
    }

    /**
     * @return HumanResource
     */
    public function getHumanResource()
    {
      return $this->HumanResource;
    }

    /**
     * @param HumanResource $HumanResource
     * @return \ProgressionWebService\HumanResourceDisponibility
     */
    public function setHumanResource($HumanResource)
    {
      $this->HumanResource = $HumanResource;
      return $this;
    }

    /**
     * @return WorkingPlanWindow[]
     */
    public function getWorkingWindows()
    {
      return $this->WorkingWindows;
    }

    /**
     * @param WorkingPlanWindow[] $WorkingWindows
     * @return \ProgressionWebService\HumanResourceDisponibility
     */
    public function setWorkingWindows(array $WorkingWindows = null)
    {
      $this->WorkingWindows = $WorkingWindows;
      return $this;
    }

}
