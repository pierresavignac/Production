<?php

namespace ProgressionWebService;

class DeleteRecordRequest
{

    /**
     * @var Credentials $credentials
     */
    protected $credentials = null;

    /**
     * @var RecordRef $recordRef
     */
    protected $recordRef = null;

    /**
     * @param Credentials $credentials
     * @param RecordRef $recordRef
     */
    public function __construct($credentials = null, $recordRef = null)
    {
      $this->credentials = $credentials;
      $this->recordRef = $recordRef;
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
     * @return \ProgressionWebService\DeleteRecordRequest
     */
    public function setCredentials($credentials)
    {
      $this->credentials = $credentials;
      return $this;
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
     * @return \ProgressionWebService\DeleteRecordRequest
     */
    public function setRecordRef($recordRef)
    {
      $this->recordRef = $recordRef;
      return $this;
    }

}
