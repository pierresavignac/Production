<?php

namespace ProgressionWebService;

class PropertyConfigurations extends Record
{

    /**
     * @var ArrayOfProperty $PropertyConfigurations
     */
    protected $PropertyConfigurations = null;

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
     * @return ArrayOfProperty
     */
    public function getPropertyConfigurations()
    {
      return $this->PropertyConfigurations;
    }

    /**
     * @param ArrayOfProperty $PropertyConfigurations
     * @return \ProgressionWebService\PropertyConfigurations
     */
    public function setPropertyConfigurations($PropertyConfigurations)
    {
      $this->PropertyConfigurations = $PropertyConfigurations;
      return $this;
    }

}
