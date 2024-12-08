<?php

namespace ProgressionWebService;

class SearchLimit
{

    /**
     * @var int $Offset
     */
    protected $Offset = null;

    /**
     * @var int $Count
     */
    protected $Count = null;

    /**
     * @param int $Offset
     * @param int $Count
     */
    public function __construct($Offset = null, $Count = null)
    {
      $this->Offset = $Offset;
      $this->Count = $Count;
    }

    /**
     * @return int
     */
    public function getOffset()
    {
      return $this->Offset;
    }

    /**
     * @param int $Offset
     * @return \ProgressionWebService\SearchLimit
     */
    public function setOffset($Offset)
    {
      $this->Offset = $Offset;
      return $this;
    }

    /**
     * @return int
     */
    public function getCount()
    {
      return $this->Count;
    }

    /**
     * @param int $Count
     * @return \ProgressionWebService\SearchLimit
     */
    public function setCount($Count)
    {
      $this->Count = $Count;
      return $this;
    }

}
