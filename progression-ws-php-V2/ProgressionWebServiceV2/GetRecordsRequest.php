<?php

namespace ProgressionWebService;

class GetRecordsRequest
{

    /**
     * @var Credentials $credentials
     */
    protected $credentials = null;

    /**
     * @var ArrayOfRecordRef $recordRefs
     */
    protected $recordRefs = null;

    /**
     * @param Credentials $credentials
     * @param ArrayOfRecordRef $recordRefs
     */
    public function __construct($credentials = null, $recordRefs = null)
    {
      $this->credentials = $credentials;
      $this->recordRefs = $recordRefs;
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
     * @return \ProgressionWebService\GetRecordsRequest
     */
    public function setCredentials($credentials)
    {
      $this->credentials = $credentials;
      return $this;
    }

    /**
     * @return ArrayOfRecordRef
     */
    public function getRecordRefs()
    {
      return $this->recordRefs;
    }

    /**
     * @param ArrayOfRecordRef $recordRefs
     * @return \ProgressionWebService\GetRecordsRequest
     */
    public function setRecordRefs($recordRefs)
    {
      $this->recordRefs = $recordRefs;
      return $this;
    }

}
