<?php

namespace ProgressionWebService;

class Role extends Record
{

    /**
     * @var ArrayOfString $Permissions
     */
    protected $Permissions = null;

    /**
     * @var EntityPermission[] $EntityPermissions
     */
    protected $EntityPermissions = null;

    /**
     * @var string $Label
     */
    protected $Label = null;

    /**
     * @param int $Id
     * @param string $UID
     * @param string $ExternalId
     * @param \DateTime $removed
     * @param anySimpleType $updated
     * @param anySimpleType $created
     * @param ArrayOfString $Permissions
     * @param string $Label
     */
    public function __construct($Id = null, $UID = null, $ExternalId = null, \DateTime $removed = null, $updated = null, $created = null, $Permissions = null, $Label = null)
    {
      parent::__construct($Id, $UID, $ExternalId, $removed, $updated, $created);
      $this->Permissions = $Permissions;
      $this->Label = $Label;
    }

    /**
     * @return ArrayOfString
     */
    public function getPermissions()
    {
      return $this->Permissions;
    }

    /**
     * @param ArrayOfString $Permissions
     * @return \ProgressionWebService\Role
     */
    public function setPermissions($Permissions)
    {
      $this->Permissions = $Permissions;
      return $this;
    }

    /**
     * @return EntityPermission[]
     */
    public function getEntityPermissions()
    {
      return $this->EntityPermissions;
    }

    /**
     * @param EntityPermission[] $EntityPermissions
     * @return \ProgressionWebService\Role
     */
    public function setEntityPermissions(array $EntityPermissions = null)
    {
      $this->EntityPermissions = $EntityPermissions;
      return $this;
    }

    /**
     * @return string
     */
    public function getLabel()
    {
      return $this->Label;
    }

    /**
     * @param string $Label
     * @return \ProgressionWebService\Role
     */
    public function setLabel($Label)
    {
      $this->Label = $Label;
      return $this;
    }

}
