<?php

namespace ProgressionWebService;

class ArrayOfRecordRef
{

    /**
     * @var RecordRef[] $RecordRef
     */
    protected $RecordRef = null;

    
    public function __construct()
    {
    
    }

    /**
     * @return RecordRef[]
     */
    public function getRecordRef()
    {
      return $this->RecordRef;
    }

    /**
     * @param RecordRef[] $RecordRef
     * @return \ProgressionWebService\ArrayOfRecordRef
     */
    public function setRecordRef(array $RecordRef = null)
    {
      $this->RecordRef = $RecordRef;
      return $this;
    }

}
