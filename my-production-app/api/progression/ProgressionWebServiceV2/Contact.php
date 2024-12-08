<?php

namespace ProgressionWebService;

class Contact extends Record
{

    /**
     * @var Address $Address
     */
    protected $Address = null;

    /**
     * @var string $Label
     */
    protected $Label = null;

    /**
     * @var string $Cell
     */
    protected $Cell = null;

    /**
     * @var string $ContactFunction
     */
    protected $ContactFunction = null;

    /**
     * @param int $Id
     * @param string $UID
     * @param string $ExternalId
     * @param \DateTime $removed
     * @param anySimpleType $updated
     * @param anySimpleType $created
     * @param string $Label
     * @param string $Cell
     * @param string $ContactFunction
     */
    public function __construct($Id = null, $UID = null, $ExternalId = null, \DateTime $removed = null, $updated = null, $created = null, $Label = null, $Cell = null, $ContactFunction = null)
    {
      parent::__construct($Id, $UID, $ExternalId, $removed, $updated, $created);
      $this->Label = $Label;
      $this->Cell = $Cell;
      $this->ContactFunction = $ContactFunction;
    }

    /**
     * @return Address
     */
    public function getAddress()
    {
      return $this->Address;
    }

    /**
     * @param Address $Address
     * @return \ProgressionWebService\Contact
     */
    public function setAddress($Address)
    {
      $this->Address = $Address;
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
     * @return \ProgressionWebService\Contact
     */
    public function setLabel($Label)
    {
      $this->Label = $Label;
      return $this;
    }

    /**
     * @return string
     */
    public function getCell()
    {
      return $this->Cell;
    }

    /**
     * @param string $Cell
     * @return \ProgressionWebService\Contact
     */
    public function setCell($Cell)
    {
      $this->Cell = $Cell;
      return $this;
    }

    /**
     * @return string
     */
    public function getContactFunction()
    {
      return $this->ContactFunction;
    }

    /**
     * @param string $ContactFunction
     * @return \ProgressionWebService\Contact
     */
    public function setContactFunction($ContactFunction)
    {
      $this->ContactFunction = $ContactFunction;
      return $this;
    }

}
