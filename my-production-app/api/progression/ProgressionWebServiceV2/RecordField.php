<?php

namespace ProgressionWebService;

class RecordField extends Property
{

    /**
     * @var RecordFieldType $Type
     */
    protected $Type = null;

    /**
     * @param string $Name
     * @param RecordFieldType $Type
     */
    public function __construct($Name = null, $Type = null)
    {
      parent::__construct($Name);
      $this->Type = $Type;
    }

    /**
     * @return RecordFieldType
     */
    public function getType()
    {
      return $this->Type;
    }

    /**
     * @param RecordFieldType $Type
     * @return \ProgressionWebService\RecordField
     */
    public function setType($Type)
    {
      $this->Type = $Type;
      return $this;
    }

}
