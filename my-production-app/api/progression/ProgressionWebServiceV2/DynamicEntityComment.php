<?php

namespace ProgressionWebService;

class DynamicEntityComment extends Comment
{

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
      parent::__construct($Id, $UID, $ExternalId, $removed, $updated, $created, $User, $UserRef, $Comment);
    }

}
