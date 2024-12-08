<?php

namespace ProgressionWebService;

class ImportFileResponse
{

    /**
     * @var int $progressSatusId
     */
    protected $progressSatusId = null;

    /**
     * @param int $progressSatusId
     */
    public function __construct($progressSatusId = null)
    {
      $this->progressSatusId = $progressSatusId;
    }

    /**
     * @return int
     */
    public function getProgressSatusId()
    {
      return $this->progressSatusId;
    }

    /**
     * @param int $progressSatusId
     * @return \ProgressionWebService\ImportFileResponse
     */
    public function setProgressSatusId($progressSatusId)
    {
      $this->progressSatusId = $progressSatusId;
      return $this;
    }

}
