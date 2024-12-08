<?php

namespace ProgressionWebService;

class OptimTimeWindow
{

    /**
     * @var time $TimeWindowStart
     */
    protected $TimeWindowStart = null;

    /**
     * @var time $TimeWindowEnd
     */
    protected $TimeWindowEnd = null;

    /**
     * @param time $TimeWindowStart
     * @param time $TimeWindowEnd
     */
    public function __construct($TimeWindowStart = null, $TimeWindowEnd = null)
    {
      $this->TimeWindowStart = $TimeWindowStart;
      $this->TimeWindowEnd = $TimeWindowEnd;
    }

    /**
     * @return time
     */
    public function getTimeWindowStart()
    {
      return $this->TimeWindowStart;
    }

    /**
     * @param time $TimeWindowStart
     * @return \ProgressionWebService\OptimTimeWindow
     */
    public function setTimeWindowStart($TimeWindowStart)
    {
      $this->TimeWindowStart = $TimeWindowStart;
      return $this;
    }

    /**
     * @return time
     */
    public function getTimeWindowEnd()
    {
      return $this->TimeWindowEnd;
    }

    /**
     * @param time $TimeWindowEnd
     * @return \ProgressionWebService\OptimTimeWindow
     */
    public function setTimeWindowEnd($TimeWindowEnd)
    {
      $this->TimeWindowEnd = $TimeWindowEnd;
      return $this;
    }

}
