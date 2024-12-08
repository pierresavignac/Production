<?php

namespace ProgressionWebService;

class UpdateRecordRequest
{

    /**
     * @var Credentials $credentials
     */
    protected $credentials = null;

    /**
     * @var Record $record
     */
    protected $record = null;

    /**
     * @var RecordRef $parentRecordRef
     */
    protected $parentRecordRef = null;

    /**
     * @param Credentials $credentials
     * @param Record $record
     */
    public function __construct($credentials = null, $record = null)
    {
      $this->credentials = $credentials;
      $this->record = $record;
    }

    /**
     * @return Credentials
     */
    public function getCredentials()
    {
      return $this->credentials;
    }

    /**
     * @param Credentials $credentials
     * @return \ProgressionWebService\UpdateRecordRequest
     */
    public function setCredentials($credentials)
    {
      $this->credentials = $credentials;
      return $this;
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
     * @return \ProgressionWebService\UpdateRecordRequest
     */
    public function setRecord($record)
    {
      $this->record = $record;
      return $this;
    }

    /**
     * @return RecordRef
     */
    public function getParentRecordRef()
    {
      return $this->parentRecordRef;
    }

    /**
     * @param RecordRef $parentRecordRef
     * @return \ProgressionWebService\UpdateRecordRequest
     */
    public function setParentRecordRef($parentRecordRef)
    {
      $this->parentRecordRef = $parentRecordRef;
      return $this;
    }

}
