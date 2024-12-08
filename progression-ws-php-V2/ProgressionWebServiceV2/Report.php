<?php

namespace ProgressionWebService;

class Report extends Record
{

    /**
     * @var ArrayOfRecord $Params
     */
    protected $Params = null;

    /**
     * @var string $Label
     */
    protected $Label = null;

    /**
     * @var string $Name
     */
    protected $Name = null;

    /**
     * @var Visibility $Visibility
     */
    protected $Visibility = null;

    /**
     * @param int $Id
     * @param string $UID
     * @param string $ExternalId
     * @param \DateTime $removed
     * @param anySimpleType $updated
     * @param anySimpleType $created
     * @param string $Label
     * @param string $Name
     * @param Visibility $Visibility
     */
    public function __construct($Id = null, $UID = null, $ExternalId = null, \DateTime $removed = null, $updated = null, $created = null, $Label = null, $Name = null, $Visibility = null)
    {
      parent::__construct($Id, $UID, $ExternalId, $removed, $updated, $created);
      $this->Label = $Label;
      $this->Name = $Name;
      $this->Visibility = $Visibility;
    }

    /**
     * @return ArrayOfRecord
     */
    public function getParams()
    {
      return $this->Params;
    }

    /**
     * @param ArrayOfRecord $Params
     * @return \ProgressionWebService\Report
     */
    public function setParams($Params)
    {
      $this->Params = $Params;
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
     * @return \ProgressionWebService\Report
     */
    public function setLabel($Label)
    {
      $this->Label = $Label;
      return $this;
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
     * @return \ProgressionWebService\Report
     */
    public function setName($Name)
    {
      $this->Name = $Name;
      return $this;
    }

    /**
     * @return Visibility
     */
    public function getVisibility()
    {
      return $this->Visibility;
    }

    /**
     * @param Visibility $Visibility
     * @return \ProgressionWebService\Report
     */
    public function setVisibility($Visibility)
    {
      $this->Visibility = $Visibility;
      return $this;
    }

}
