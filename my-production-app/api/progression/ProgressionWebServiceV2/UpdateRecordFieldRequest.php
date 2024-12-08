<?php

namespace ProgressionWebService;

class UpdateRecordFieldRequest
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
     * @var RecordFieldType $recordFieldType
     */
    protected $recordFieldType = null;

    /**
     * @var Property $property
     */
    protected $property = null;

    /**
     * @param Credentials $credentials
     * @param RecordRef $recordRef
     * @param RecordFieldType $recordFieldType
     * @param Property $property
     */
    public function __construct($credentials = null, $recordRef = null, $recordFieldType = null, $property = null)
    {
      $this->credentials = $credentials;
      $this->recordRef = $recordRef;
      $this->recordFieldType = $recordFieldType;
      $this->property = $property;
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
     * @return \ProgressionWebService\UpdateRecordFieldRequest
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
     * @return \ProgressionWebService\UpdateRecordFieldRequest
     */
    public function setRecordRef($recordRef)
    {
      $this->recordRef = $recordRef;
      return $this;
    }

    /**
     * @return RecordFieldType
     */
    public function getRecordFieldType()
    {
      return $this->recordFieldType;
    }

    /**
     * @param RecordFieldType $recordFieldType
     * @return \ProgressionWebService\UpdateRecordFieldRequest
     */
    public function setRecordFieldType($recordFieldType)
    {
      $this->recordFieldType = $recordFieldType;
      return $this;
    }

    /**
     * @return Property
     */
    public function getProperty()
    {
      return $this->property;
    }

    /**
     * @param Property $property
     * @return \ProgressionWebService\UpdateRecordFieldRequest
     */
    public function setProperty($property)
    {
      $this->property = $property;
      return $this;
    }

}
