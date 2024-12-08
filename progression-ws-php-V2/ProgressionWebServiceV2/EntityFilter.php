<?php

namespace ProgressionWebService;

class EntityFilter extends Record
{

    /**
     * @var string $Name
     */
    protected $Name = null;

    /**
     * @var ArrayOfFilter $Filters
     */
    protected $Filters = null;

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
     * @return string
     */
    public function getName()
    {
      return $this->Name;
    }

    /**
     * @param string $Name
     * @return \ProgressionWebService\EntityFilter
     */
    public function setName($Name)
    {
      $this->Name = $Name;
      return $this;
    }

    /**
     * @return ArrayOfFilter
     */
    public function getFilters()
    {
      return $this->Filters;
    }

    /**
     * @param ArrayOfFilter $Filters
     * @return \ProgressionWebService\EntityFilter
     */
    public function setFilters($Filters)
    {
      $this->Filters = $Filters;
      return $this;
    }

}
