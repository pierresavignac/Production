<?php

namespace ProgressionWebService;

class Message extends Record
{

    /**
     * @var ArrayOfRecord $Recipients
     */
    protected $Recipients = null;

    /**
     * @var ArrayOfRecordRef $AttachmentRefs
     */
    protected $AttachmentRefs = null;

    /**
     * @var boolean $Important
     */
    protected $Important = null;

    /**
     * @var string $Subject
     */
    protected $Subject = null;

    /**
     * @var string $Body
     */
    protected $Body = null;

    /**
     * @param int $Id
     * @param string $UID
     * @param string $ExternalId
     * @param \DateTime $removed
     * @param anySimpleType $updated
     * @param anySimpleType $created
     * @param boolean $Important
     * @param string $Subject
     * @param string $Body
     */
    public function __construct($Id = null, $UID = null, $ExternalId = null, \DateTime $removed = null, $updated = null, $created = null, $Important = null, $Subject = null, $Body = null)
    {
      parent::__construct($Id, $UID, $ExternalId, $removed, $updated, $created);
      $this->Important = $Important;
      $this->Subject = $Subject;
      $this->Body = $Body;
    }

    /**
     * @return ArrayOfRecord
     */
    public function getRecipients()
    {
      return $this->Recipients;
    }

    /**
     * @param ArrayOfRecord $Recipients
     * @return \ProgressionWebService\Message
     */
    public function setRecipients($Recipients)
    {
      $this->Recipients = $Recipients;
      return $this;
    }

    /**
     * @return ArrayOfRecordRef
     */
    public function getAttachmentRefs()
    {
      return $this->AttachmentRefs;
    }

    /**
     * @param ArrayOfRecordRef $AttachmentRefs
     * @return \ProgressionWebService\Message
     */
    public function setAttachmentRefs($AttachmentRefs)
    {
      $this->AttachmentRefs = $AttachmentRefs;
      return $this;
    }

    /**
     * @return boolean
     */
    public function getImportant()
    {
      return $this->Important;
    }

    /**
     * @param boolean $Important
     * @return \ProgressionWebService\Message
     */
    public function setImportant($Important)
    {
      $this->Important = $Important;
      return $this;
    }

    /**
     * @return string
     */
    public function getSubject()
    {
      return $this->Subject;
    }

    /**
     * @param string $Subject
     * @return \ProgressionWebService\Message
     */
    public function setSubject($Subject)
    {
      $this->Subject = $Subject;
      return $this;
    }

    /**
     * @return string
     */
    public function getBody()
    {
      return $this->Body;
    }

    /**
     * @param string $Body
     * @return \ProgressionWebService\Message
     */
    public function setBody($Body)
    {
      $this->Body = $Body;
      return $this;
    }

}
