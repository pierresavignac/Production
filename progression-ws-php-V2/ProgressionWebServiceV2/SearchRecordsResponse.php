<?php

namespace ProgressionWebService;

class SearchRecordsResponse
{

    /**
     * @var ArrayOfRecord $records
     */
    protected $records = null;

    /**
     * @param ArrayOfRecord $records
     */
    public function __construct($records = null)
    {
      $this->records = $records;
    }

    /**
     * @return ArrayOfRecord
     */
    public function getRecords()
    {
      return $this->records;
    }

    /**
     * @param ArrayOfRecord $records
     * @return \ProgressionWebService\SearchRecordsResponse
     */
    public function setRecords($records)
    {
      $this->records = $records;
      return $this;
    }

}
