<?php

namespace ProgressionWebService;

class EntityPermission
{

    /**
     * @var string $EntityName
     */
    protected $EntityName = null;

    /**
     * @var boolean $Create
     */
    protected $Create = null;

    /**
     * @var boolean $Read
     */
    protected $Read = null;

    /**
     * @var boolean $Update
     */
    protected $Update = null;

    /**
     * @var boolean $Delete
     */
    protected $Delete = null;

    /**
     * @param string $EntityName
     * @param boolean $Create
     * @param boolean $Read
     * @param boolean $Update
     * @param boolean $Delete
     */
    public function __construct($EntityName = null, $Create = null, $Read = null, $Update = null, $Delete = null)
    {
      $this->EntityName = $EntityName;
      $this->Create = $Create;
      $this->Read = $Read;
      $this->Update = $Update;
      $this->Delete = $Delete;
    }

    /**
     * @return string
     */
    public function getEntityName()
    {
      return $this->EntityName;
    }

    /**
     * @param string $EntityName
     * @return \ProgressionWebService\EntityPermission
     */
    public function setEntityName($EntityName)
    {
      $this->EntityName = $EntityName;
      return $this;
    }

    /**
     * @return boolean
     */
    public function getCreate()
    {
      return $this->Create;
    }

    /**
     * @param boolean $Create
     * @return \ProgressionWebService\EntityPermission
     */
    public function setCreate($Create)
    {
      $this->Create = $Create;
      return $this;
    }

    /**
     * @return boolean
     */
    public function getRead()
    {
      return $this->Read;
    }

    /**
     * @param boolean $Read
     * @return \ProgressionWebService\EntityPermission
     */
    public function setRead($Read)
    {
      $this->Read = $Read;
      return $this;
    }

    /**
     * @return boolean
     */
    public function getUpdate()
    {
      return $this->Update;
    }

    /**
     * @param boolean $Update
     * @return \ProgressionWebService\EntityPermission
     */
    public function setUpdate($Update)
    {
      $this->Update = $Update;
      return $this;
    }

    /**
     * @return boolean
     */
    public function getDelete()
    {
      return $this->Delete;
    }

    /**
     * @param boolean $Delete
     * @return \ProgressionWebService\EntityPermission
     */
    public function setDelete($Delete)
    {
      $this->Delete = $Delete;
      return $this;
    }

}
