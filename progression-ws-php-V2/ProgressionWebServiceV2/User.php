<?php

namespace ProgressionWebService;

class User extends Record
{

    /**
     * @var RecordRef $RoleRef
     */
    protected $RoleRef = null;

    /**
     * @var RecordRef $HumanResourceRef
     */
    protected $HumanResourceRef = null;

    /**
     * @var string $Email
     */
    protected $Email = null;

    /**
     * @var string $Telephone
     */
    protected $Telephone = null;

    /**
     * @var string $Password
     */
    protected $Password = null;

    /**
     * @var string $UniqueMobileId
     */
    protected $UniqueMobileId = null;

    /**
     * @param int $Id
     * @param string $UID
     * @param string $ExternalId
     * @param \DateTime $removed
     * @param anySimpleType $updated
     * @param anySimpleType $created
     * @param RecordRef $RoleRef
     * @param RecordRef $HumanResourceRef
     * @param string $Email
     * @param string $Telephone
     * @param string $Password
     * @param string $UniqueMobileId
     */
    public function __construct($Id = null, $UID = null, $ExternalId = null, \DateTime $removed = null, $updated = null, $created = null, $RoleRef = null, $HumanResourceRef = null, $Email = null, $Telephone = null, $Password = null, $UniqueMobileId = null)
    {
      parent::__construct($Id, $UID, $ExternalId, $removed, $updated, $created);
      $this->RoleRef = $RoleRef;
      $this->HumanResourceRef = $HumanResourceRef;
      $this->Email = $Email;
      $this->Telephone = $Telephone;
      $this->Password = $Password;
      $this->UniqueMobileId = $UniqueMobileId;
    }

    /**
     * @return RecordRef
     */
    public function getRoleRef()
    {
      return $this->RoleRef;
    }

    /**
     * @param RecordRef $RoleRef
     * @return \ProgressionWebService\User
     */
    public function setRoleRef($RoleRef)
    {
      $this->RoleRef = $RoleRef;
      return $this;
    }

    /**
     * @return RecordRef
     */
    public function getHumanResourceRef()
    {
      return $this->HumanResourceRef;
    }

    /**
     * @param RecordRef $HumanResourceRef
     * @return \ProgressionWebService\User
     */
    public function setHumanResourceRef($HumanResourceRef)
    {
      $this->HumanResourceRef = $HumanResourceRef;
      return $this;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
      return $this->Email;
    }

    /**
     * @param string $Email
     * @return \ProgressionWebService\User
     */
    public function setEmail($Email)
    {
      $this->Email = $Email;
      return $this;
    }

    /**
     * @return string
     */
    public function getTelephone()
    {
      return $this->Telephone;
    }

    /**
     * @param string $Telephone
     * @return \ProgressionWebService\User
     */
    public function setTelephone($Telephone)
    {
      $this->Telephone = $Telephone;
      return $this;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
      return $this->Password;
    }

    /**
     * @param string $Password
     * @return \ProgressionWebService\User
     */
    public function setPassword($Password)
    {
      $this->Password = $Password;
      return $this;
    }

    /**
     * @return string
     */
    public function getUniqueMobileId()
    {
      return $this->UniqueMobileId;
    }

    /**
     * @param string $UniqueMobileId
     * @return \ProgressionWebService\User
     */
    public function setUniqueMobileId($UniqueMobileId)
    {
      $this->UniqueMobileId = $UniqueMobileId;
      return $this;
    }

}
