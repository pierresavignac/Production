<?php

namespace ProgressionWebService;

class GetFilesDataRequest
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
     * @var int $maxSize
     */
    protected $maxSize = null;

    /**
     * @param Credentials $credentials
     * @param ArrayOfRecordRef $recordRefs
     * @param int $maxSize
     */
    public function __construct($credentials = null, $recordRefs = null, $maxSize = null)
    {
      $this->credentials = $credentials;
      $this->recordRefs = $recordRefs;
      $this->maxSize = $maxSize;
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
     * @return \ProgressionWebService\GetFilesDataRequest
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
     * @return \ProgressionWebService\GetFilesDataRequest
     */
    public function setRecordRefs($recordRefs)
    {
      $this->recordRefs = $recordRefs;
      return $this;
    }

    /**
     * @return int
     */
    public function getMaxSize()
    {
      return $this->maxSize;
    }

    /**
     * @param int $maxSize
     * @return \ProgressionWebService\GetFilesDataRequest
     */
    public function setMaxSize($maxSize)
    {
      $this->maxSize = $maxSize;
      return $this;
    }

}
