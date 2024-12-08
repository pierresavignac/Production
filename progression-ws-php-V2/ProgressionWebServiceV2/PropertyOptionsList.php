<?php

namespace ProgressionWebService;

class PropertyOptionsList extends Record
{

    /**
     * @var ArrayOfString $Options
     */
    protected $Options = null;

    /**
     * @var string $Label
     */
    protected $Label = null;

    /**
     * @param int $Id
     * @param string $UID
     * @param string $ExternalId
     * @param \DateTime $removed
     * @param anySimpleType $updated
     * @param anySimpleType $created
     * @param string $Label
     */
    public function __construct($Id = null, $UID = null, $ExternalId = null, \DateTime $removed = null, $updated = null, $created = null, $Label = null)
    {
      parent::__construct($Id, $UID, $ExternalId, $removed, $updated, $created);
      $this->Label = $Label;
    }

    /**
     * @return ArrayOfString
     */
    public function getOptions()
    {
      return $this->Options;
    }

    /**
     * @param ArrayOfString $Options
     * @return \ProgressionWebService\PropertyOptionsList
     */
    public function setOptions($Options)
    {
      $this->Options = $Options;
      return $this;
    }

    /**
     * @return string
     */
    public function getLabel()
    {
      return $this->Label;
    }

    /**
     * @param string $Label
     * @return \ProgressionWebService\PropertyOptionsList
     */
    public function setLabel($Label)
    {
      $this->Label = $Label;
      return $this;
    }

}
