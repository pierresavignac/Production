<?php

namespace ProgressionWebService;

class NodeType extends Type
{

    /**
     * @param int $Id
     * @param string $UID
     * @param string $ExternalId
     * @param \DateTime $removed
     * @param anySimpleType $updated
     * @param anySimpleType $created
     * @param string $Label
     * @param boolean $mobileAllowCreate
     * @param boolean $defaultType
     * @param boolean $allowCreate
     */
    public function __construct($Id = null, $UID = null, $ExternalId = null, \DateTime $removed = null, $updated = null, $created = null, $Label = null, $mobileAllowCreate = null, $defaultType = null, $allowCreate = null)
    {
      parent::__construct($Id, $UID, $ExternalId, $removed, $updated, $created, $Label, $mobileAllowCreate, $defaultType, $allowCreate);
    }

}
