<?php

namespace ProgressionWebService;

class UpdateRecordsFieldsRequest
{

    /**
     * @var Credentials $credentials
     */
    protected $credentials = null;

    /**
     * @var recordFields $recordFields
     */
    protected $recordFields = null;

    /**
     * @param Credentials $credentials
     * @param recordFields $recordFields
     */
    public function __construct($credentials = null, $recordFields = null)
    {
      $this->credentials = $credentials;
      $this->recordFields = $recordFields;
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
     * @return \ProgressionWebService\UpdateRecordsFieldsRequest
     */
    public function setCredentials($credentials)
    {
      $this->credentials = $credentials;
      return $this;
    }

    /**
     * @return recordFields
     */
    public function getRecordFields()
    {
      return $this->recordFields;
    }

    /**
     * @param recordFields $recordFields
     * @return \ProgressionWebService\UpdateRecordsFieldsRequest
     */
    public function setRecordFields($recordFields)
    {
      $this->recordFields = $recordFields;
      return $this;
    }

}
