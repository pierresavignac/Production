<?php

namespace ProgressionWebService;

class SearchRecordsRequest
{

    /**
     * @var Credentials $credentials
     */
    protected $credentials = null;

    /**
     * @var RecordType $recordType
     */
    protected $recordType = null;

    /**
     * @var string $query
     */
    protected $query = null;

    /**
     * @var ArrayOfProperty $parameters
     */
    protected $parameters = null;

    /**
     * @var SearchLimit $limit
     */
    protected $limit = null;

    /**
     * @var SearchLocation $location
     */
    protected $location = null;

    /**
     * @param Credentials $credentials
     * @param RecordType $recordType
     * @param string $query
     */
    public function __construct($credentials = null, $recordType = null, $query = null)
    {
      $this->credentials = $credentials;
      $this->recordType = $recordType;
      $this->query = $query;
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
     * @return \ProgressionWebService\SearchRecordsRequest
     */
    public function setCredentials($credentials)
    {
      $this->credentials = $credentials;
      return $this;
    }

    /**
     * @return RecordType
     */
    public function getRecordType()
    {
      return $this->recordType;
    }

    /**
     * @param RecordType $recordType
     * @return \ProgressionWebService\SearchRecordsRequest
     */
    public function setRecordType($recordType)
    {
      $this->recordType = $recordType;
      return $this;
    }

    /**
     * @return string
     */
    public function getQuery()
    {
      return $this->query;
    }

    /**
     * @param string $query
     * @return \ProgressionWebService\SearchRecordsRequest
     */
    public function setQuery($query)
    {
      $this->query = $query;
      return $this;
    }

    /**
     * @return ArrayOfProperty
     */
    public function getParameters()
    {
      return $this->parameters;
    }

    /**
     * @param ArrayOfProperty $parameters
     * @return \ProgressionWebService\SearchRecordsRequest
     */
    public function setParameters($parameters)
    {
      $this->parameters = $parameters;
      return $this;
    }

    /**
     * @return SearchLimit
     */
    public function getLimit()
    {
      return $this->limit;
    }

    /**
     * @param SearchLimit $limit
     * @return \ProgressionWebService\SearchRecordsRequest
     */
    public function setLimit($limit)
    {
      $this->limit = $limit;
      return $this;
    }

    /**
     * @return SearchLocation
     */
    public function getLocation()
    {
      return $this->location;
    }

    /**
     * @param SearchLocation $location
     * @return \ProgressionWebService\SearchRecordsRequest
     */
    public function setLocation($location)
    {
      $this->location = $location;
      return $this;
    }

}
