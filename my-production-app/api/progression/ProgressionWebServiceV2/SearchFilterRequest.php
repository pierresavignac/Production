<?php

namespace ProgressionWebService;

class SearchFilterRequest
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
     * @var EntityFilter $filter
     */
    protected $filter = null;

    /**
     * @var SearchLimit $limit
     */
    protected $limit = null;

    /**
     * @param Credentials $credentials
     * @param RecordType $recordType
     * @param EntityFilter $filter
     */
    public function __construct($credentials = null, $recordType = null, $filter = null)
    {
      $this->credentials = $credentials;
      $this->recordType = $recordType;
      $this->filter = $filter;
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
     * @return \ProgressionWebService\SearchFilterRequest
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
     * @return \ProgressionWebService\SearchFilterRequest
     */
    public function setRecordType($recordType)
    {
      $this->recordType = $recordType;
      return $this;
    }

    /**
     * @return EntityFilter
     */
    public function getFilter()
    {
      return $this->filter;
    }

    /**
     * @param EntityFilter $filter
     * @return \ProgressionWebService\SearchFilterRequest
     */
    public function setFilter($filter)
    {
      $this->filter = $filter;
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
     * @return \ProgressionWebService\SearchFilterRequest
     */
    public function setLimit($limit)
    {
      $this->limit = $limit;
      return $this;
    }

}
