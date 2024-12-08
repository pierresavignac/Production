<?php

namespace ProgressionWebService;

class recordFields
{

    /**
     * @var RecordRef $recordRef
     */
    protected $recordRef = null;

    /**
     * @var ArrayOfRecordField $recordFields
     */
    protected $recordFields = null;

    /**
     * @param RecordRef $recordRef
     * @param ArrayOfRecordField $recordFields
     */
    public function __construct($recordRef = null, $recordFields = null)
    {
      $this->recordRef = $recordRef;
      $this->recordFields = $recordFields;
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
     * @return \ProgressionWebService\recordFields
     */
    public function setRecordRef($recordRef)
    {
      $this->recordRef = $recordRef;
      return $this;
    }

    /**
     * @return ArrayOfRecordField
     */
    public function getRecordFields()
    {
      return $this->recordFields;
    }

    /**
     * @param ArrayOfRecordField $recordFields
     * @return \ProgressionWebService\recordFields
     */
    public function setRecordFields($recordFields)
    {
      $this->recordFields = $recordFields;
      return $this;
    }

}
