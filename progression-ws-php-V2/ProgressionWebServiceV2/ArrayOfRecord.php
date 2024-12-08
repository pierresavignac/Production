<?php

namespace ProgressionWebService;

class ArrayOfRecord
{

    /**
     * @var Record[] $Record
     */
    protected $Record = null;

    
    public function __construct()
    {
    
    }

    /**
     * @return Record[]
     */
    public function getRecord()
    {
      return $this->Record;
    }

    /**
     * @param Record[] $Record
     * @return \ProgressionWebService\ArrayOfRecord
     */
    public function setRecord(array $Record = null)
    {
      $this->Record = $Record;
      return $this;
    }

}
