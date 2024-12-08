<?php

namespace ProgressionWebService;

class UpdateRecordFieldsRequest
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
     * @var ArrayOfRecordField $recordFields
     */
    protected $recordFields = null;

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
     * @return \ProgressionWebService\UpdateRecordFieldsRequest
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
     * @return \ProgressionWebService\UpdateRecordFieldsRequest
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
     * @return \ProgressionWebService\UpdateRecordFieldsRequest
     */
    public function setRecordFields($recordFields)
    {
      $this->recordFields = $recordFields;
      return $this;
    }

}
