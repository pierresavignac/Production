<?php

namespace ProgressionWebService;

class Comment extends Record
{

    /**
     * @var string $User
     */
    protected $User = null;

    /**
     * @var RecordRef $UserRef
     */
    protected $UserRef = null;

    /**
     * @var string $Comment
     */
    protected $Comment = null;

    /**
     * @param int $Id
     * @param string $UID
     * @param string $ExternalId
     * @param \DateTime $removed
     * @param anySimpleType $updated
     * @param anySimpleType $created
     * @param string $User
     * @param RecordRef $UserRef
     * @param string $Comment
     */
    public function __construct($Id = null, $UID = null, $ExternalId = null, \DateTime $removed = null, $updated = null, $created = null, $User = null, $UserRef = null, $Comment = null)
    {
      parent::__construct($Id, $UID, $ExternalId, $removed, $updated, $created);
      $this->User = $User;
      $this->UserRef = $UserRef;
      $this->Comment = $Comment;
    }

    /**
     * @return string
     */
    public function getUser()
    {
      return $this->User;
    }

    /**
     * @param string $User
     * @return \ProgressionWebService\Comment
     */
    public function setUser($User)
    {
      $this->User = $User;
      return $this;
    }

    /**
     * @return RecordRef
     */
    public function getUserRef()
    {
      return $this->UserRef;
    }

    /**
     * @param RecordRef $UserRef
     * @return \ProgressionWebService\Comment
     */
    public function setUserRef($UserRef)
    {
      $this->UserRef = $UserRef;
      return $this;
    }

    /**
     * @return string
     */
    public function getComment()
    {
      return $this->Comment;
    }

    /**
     * @param string $Comment
     * @return \ProgressionWebService\Comment
     */
    public function setComment($Comment)
    {
      $this->Comment = $Comment;
      return $this;
    }

}
