<?php

namespace ProgressionWebService;

class ArrayOfRecordField
{

    /**
     * @var RecordField[] $RecordField
     */
    protected $RecordField = null;

    
    public function __construct()
    {
    
    }

    /**
     * @return RecordField[]
     */
    public function getRecordField()
    {
      return $this->RecordField;
    }

    /**
     * @param RecordField[] $RecordField
     * @return \ProgressionWebService\ArrayOfRecordField
     */
    public function setRecordField(array $RecordField = null)
    {
      $this->RecordField = $RecordField;
      return $this;
    }

}
