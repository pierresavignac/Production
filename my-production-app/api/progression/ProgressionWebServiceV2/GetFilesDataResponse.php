<?php

namespace ProgressionWebService;

class GetFilesDataResponse
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
     * @return \ProgressionWebService\GetFilesDataResponse
     */
    public function setRecords($records)
    {
      $this->records = $records;
      return $this;
    }

}
