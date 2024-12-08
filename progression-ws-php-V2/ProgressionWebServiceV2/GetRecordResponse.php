<?php

namespace ProgressionWebService;

class GetRecordResponse
{

    /**
     * @var Record $record
     */
    protected $record = null;

    /**
     * @param Record $record
     */
    public function __construct($record = null)
    {
      $this->record = $record;
    }

    /**
     * @return Record
     */
    public function getRecord()
    {
      return $this->record;
    }

    /**
     * @param Record $record
     * @return \ProgressionWebService\GetRecordResponse
     */
    public function setRecord($record)
    {
      $this->record = $record;
      return $this;
    }

}
