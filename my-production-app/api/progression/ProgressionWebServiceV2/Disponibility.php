<?php

namespace ProgressionWebService;

class Disponibility extends Record
{

    /**
     * @var string $Label
     */
    protected $Label = null;

    /**
     * @var string $Icon
     */
    protected $Icon = null;

    /**
     * @param int $Id
     * @param string $UID
     * @param string $ExternalId
     * @param \DateTime $removed
     * @param anySimpleType $updated
     * @param anySimpleType $created
     * @param string $Label
     * @param string $Icon
     */
    public function __construct($Id = null, $UID = null, $ExternalId = null, \DateTime $removed = null, $updated = null, $created = null, $Label = null, $Icon = null)
    {
      parent::__construct($Id, $UID, $ExternalId, $removed, $updated, $created);
      $this->Label = $Label;
      $this->Icon = $Icon;
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
     * @return \ProgressionWebService\Disponibility
     */
    public function setLabel($Label)
    {
      $this->Label = $Label;
      return $this;
    }

    /**
     * @return string
     */
    public function getIcon()
    {
      return $this->Icon;
    }

    /**
     * @param string $Icon
     * @return \ProgressionWebService\Disponibility
     */
    public function setIcon($Icon)
    {
      $this->Icon = $Icon;
      return $this;
    }

}
