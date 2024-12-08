<?php

namespace ProgressionWebService;

class ArrayOfProperty
{

    /**
     * @var Property[] $Property
     */
    protected $Property = null;

    
    public function __construct()
    {
    
    }

    /**
     * @return Property[]
     */
    public function getProperty()
    {
      return $this->Property;
    }

    /**
     * @param Property[] $Property
     * @return \ProgressionWebService\ArrayOfProperty
     */
    public function setProperty(array $Property = null)
    {
      $this->Property = $Property;
      return $this;
    }

}
