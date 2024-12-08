<?php

namespace ProgressionWebService;

class ArrayOfCieConfig
{

    /**
     * @var CieConfig[] $CieConfig
     */
    protected $CieConfig = null;

    
    public function __construct()
    {
    
    }

    /**
     * @return CieConfig[]
     */
    public function getCieConfig()
    {
      return $this->CieConfig;
    }

    /**
     * @param CieConfig[] $CieConfig
     * @return \ProgressionWebService\ArrayOfCieConfig
     */
    public function setCieConfig(array $CieConfig = null)
    {
      $this->CieConfig = $CieConfig;
      return $this;
    }

}
