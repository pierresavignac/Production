<?php

namespace ProgressionWebService;

class Filter
{

    /**
     * @var anyType $Value
     */
    protected $Value = null;

    /**
     * @var string $Name
     */
    protected $Name = null;

    /**
     * @var FilterType $Type
     */
    protected $Type = null;

    /**
     * @var FilterOperator $Operator
     */
    protected $Operator = null;

    /**
     * @param string $Name
     * @param FilterType $Type
     * @param FilterOperator $Operator
     */
    public function __construct($Name = null, $Type = null, $Operator = null)
    {
      $this->Name = $Name;
      $this->Type = $Type;
      $this->Operator = $Operator;
    }

    /**
     * @return anyType
     */
    public function getValue()
    {
      return $this->Value;
    }

    /**
     * @param anyType $Value
     * @return \ProgressionWebService\Filter
     */
    public function setValue($Value)
    {
      $this->Value = $Value;
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
     * @return \ProgressionWebService\Filter
     */
    public function setName($Name)
    {
      $this->Name = $Name;
      return $this;
    }

    /**
     * @return FilterType
     */
    public function getType()
    {
      return $this->Type;
    }

    /**
     * @param FilterType $Type
     * @return \ProgressionWebService\Filter
     */
    public function setType($Type)
    {
      $this->Type = $Type;
      return $this;
    }

    /**
     * @return FilterOperator
     */
    public function getOperator()
    {
      return $this->Operator;
    }

    /**
     * @param FilterOperator $Operator
     * @return \ProgressionWebService\Filter
     */
    public function setOperator($Operator)
    {
      $this->Operator = $Operator;
      return $this;
    }

}
