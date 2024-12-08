<?php

namespace ProgressionWebService;

class CreateRecordRequest
{

    /**
     * @var Credentials $credentials
     */
    protected $credentials = null;

    /**
     * @var RecordRef $parentRecordRef
     */
    protected $parentRecordRef = null;

    /**
     * @var Record $record
     */
    protected $record = null;

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
     * @return \ProgressionWebService\CreateRecordRequest
     */
    public function setCredentials($credentials)
    {
      $this->credentials = $credentials;
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
     * @return \ProgressionWebService\CreateRecordRequest
     */
    public function setParentRecordRef($parentRecordRef)
    {
      $this->parentRecordRef = $parentRecordRef;
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
     * @return \ProgressionWebService\CreateRecordRequest
     */
    public function setRecord($record)
    {
      $this->record = $record;
      return $this;
    }

}
