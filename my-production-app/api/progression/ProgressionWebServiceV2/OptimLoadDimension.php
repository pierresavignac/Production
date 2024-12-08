<?php

namespace ProgressionWebService;

class OptimLoadDimension extends Record
{

    /**
     * @var string $Name
     */
    protected $Name = null;

    /**
     * @param int $Id
     * @param string $UID
     * @param string $ExternalId
     * @param \DateTime $removed
     * @param anySimpleType $updated
     * @param anySimpleType $created
     * @param string $Name
     */
    public function __construct($Id = null, $UID = null, $ExternalId = null, \DateTime $removed = null, $updated = null, $created = null, $Name = null)
    {
      parent::__construct($Id, $UID, $ExternalId, $removed, $updated, $created);
      $this->Name = $Name;
    }

    /**
     * @return string
     */
    public function getName()
    {
      return $this->Name;
    }

    /**
     * @param string $Name
     * @return \ProgressionWebService\OptimLoadDimension
     */
    public function setName($Name)
    {
      $this->Name = $Name;
      return $this;
    }

}
