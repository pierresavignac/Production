<?php

namespace ProgressionWebService;

class NodeAttachment extends Attachment
{

    /**
     * @param int $Id
     * @param string $UID
     * @param string $ExternalId
     * @param \DateTime $removed
     * @param anySimpleType $updated
     * @param anySimpleType $created
     * @param RecordRef $TypeRef
     * @param string $Name
     * @param int $Size
     */
    public function __construct($Id = null, $UID = null, $ExternalId = null, \DateTime $removed = null, $updated = null, $created = null, $TypeRef = null, $Name = null, $Size = null)
    {
      parent::__construct($Id, $UID, $ExternalId, $removed, $updated, $created, $TypeRef, $Name, $Size);
    }

}
