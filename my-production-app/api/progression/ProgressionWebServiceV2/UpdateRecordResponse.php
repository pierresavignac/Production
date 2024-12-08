<?php

namespace ProgressionWebService;

class UpdateRecordResponse
{

    /**
     * @var RecordRef $recordRef
     */
    protected $recordRef = null;

    /**
     * @param RecordRef $recordRef
     */
    public function __construct($recordRef = null)
    {
      $this->recordRef = $recordRef;
    }

    /**
     * @return RecordRef
     */
    public function getRecordRef()
    {
      return $this->recordRef;
    }

    /**
     * @param RecordRef $recordRef
     * @return \ProgressionWebService\UpdateRecordResponse
     */
    public function setRecordRef($recordRef)
    {
      $this->recordRef = $recordRef;
      return $this;
    }

}
