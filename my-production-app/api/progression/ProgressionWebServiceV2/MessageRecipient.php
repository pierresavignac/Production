<?php

namespace ProgressionWebService;

class MessageRecipient extends Record
{

    /**
     * @var RecordRef $MessageRef
     */
    protected $MessageRef = null;

    /**
     * @var RecordRef $User
     */
    protected $User = null;

    /**
     * @var \DateTime $Read
     */
    protected $Read = null;

    /**
     * @param int $Id
     * @param string $UID
     * @param string $ExternalId
     * @param \DateTime $removed
     * @param anySimpleType $updated
     * @param anySimpleType $created
     */
    public function __construct($Id = null, $UID = null, $ExternalId = null, \DateTime $removed = null, $updated = null, $created = null)
    {
      parent::__construct($Id, $UID, $ExternalId, $removed, $updated, $created);
    }

    /**
     * @return RecordRef
     */
    public function getMessageRef()
    {
      return $this->MessageRef;
    }

    /**
     * @param RecordRef $MessageRef
     * @return \ProgressionWebService\MessageRecipient
     */
    public function setMessageRef($MessageRef)
    {
      $this->MessageRef = $MessageRef;
      return $this;
    }

    /**
     * @return RecordRef
     */
    public function getUser()
    {
      return $this->User;
    }

    /**
     * @param RecordRef $User
     * @return \ProgressionWebService\MessageRecipient
     */
    public function setUser($User)
    {
      $this->User = $User;
      return $this;
    }

    /**
     * @return \DateTime
     */
    public function getRead()
    {
      if ($this->Read == null) {
        return null;
      } else {
        try {
          return new \DateTime($this->Read);
        } catch (\Exception $e) {
          return false;
        }
      }
    }

    /**
     * @param \DateTime $Read
     * @return \ProgressionWebService\MessageRecipient
     */
    public function setRead(\DateTime $Read = null)
    {
      if ($Read == null) {
       $this->Read = null;
      } else {
        $this->Read = $Read->format(\DateTime::ATOM);
      }
      return $this;
    }

}
