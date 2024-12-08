<?php

namespace ProgressionWebService;

class ImportFileRequest
{

    /**
     * @var Credentials $credentials
     */
    protected $credentials = null;

    /**
     * @var string $importName
     */
    protected $importName = null;

    /**
     * @var ArrayOfProperty $parameters
     */
    protected $parameters = null;

    /**
     * @var base64Binary $file
     */
    protected $file = null;

    /**
     * @param Credentials $credentials
     * @param string $importName
     * @param ArrayOfProperty $parameters
     * @param base64Binary $file
     */
    public function __construct($credentials = null, $importName = null, $parameters = null, $file = null)
    {
      $this->credentials = $credentials;
      $this->importName = $importName;
      $this->parameters = $parameters;
      $this->file = $file;
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
     * @return \ProgressionWebService\ImportFileRequest
     */
    public function setCredentials($credentials)
    {
      $this->credentials = $credentials;
      return $this;
    }

    /**
     * @return string
     */
    public function getImportName()
    {
      return $this->importName;
    }

    /**
     * @param string $importName
     * @return \ProgressionWebService\ImportFileRequest
     */
    public function setImportName($importName)
    {
      $this->importName = $importName;
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
     * @return \ProgressionWebService\ImportFileRequest
     */
    public function setParameters($parameters)
    {
      $this->parameters = $parameters;
      return $this;
    }

    /**
     * @return base64Binary
     */
    public function getFile()
    {
      return $this->file;
    }

    /**
     * @param base64Binary $file
     * @return \ProgressionWebService\ImportFileRequest
     */
    public function setFile($file)
    {
      $this->file = $file;
      return $this;
    }

}
