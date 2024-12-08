<?php

namespace ProgressionWebService;

class ProductImage extends FileData
{

    /**
     * @param int $Id
     * @param string $UID
     * @param string $ExternalId
     * @param \DateTime $removed
     * @param anySimpleType $updated
     * @param anySimpleType $created
     * @param string $Name
     * @param string $ContentType
     * @param int $Size
     * @param base64Binary $Data
     */
    public function __construct($Id = null, $UID = null, $ExternalId = null, \DateTime $removed = null, $updated = null, $created = null, $Name = null, $ContentType = null, $Size = null, $Data = null)
    {
      parent::__construct($Id, $UID, $ExternalId, $removed, $updated, $created, $Name, $ContentType, $Size, $Data);
    }

}
