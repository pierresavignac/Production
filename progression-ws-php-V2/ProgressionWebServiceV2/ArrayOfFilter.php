<?php

namespace ProgressionWebService;

class ArrayOfFilter
{

    /**
     * @var Filter[] $Filters
     */
    protected $Filters = null;

    
    public function __construct()
    {
    
    }

    /**
     * @return Filter[]
     */
    public function getFilters()
    {
      return $this->Filters;
    }

    /**
     * @param Filter[] $Filters
     * @return \ProgressionWebService\ArrayOfFilter
     */
    public function setFilters(array $Filters = null)
    {
      $this->Filters = $Filters;
      return $this;
    }

}
