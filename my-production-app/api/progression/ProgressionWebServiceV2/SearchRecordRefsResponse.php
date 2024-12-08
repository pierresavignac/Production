<?php

namespace ProgressionWebService;

class SearchRecordRefsResponse
{

    /**
     * @var ArrayOfRecordRef $recordRefs
     */
    protected $recordRefs = null;

    /**
     * @param ArrayOfRecordRef $recordRefs
     */
    public function __construct($recordRefs = null)
    {
      $this->recordRefs = $recordRefs;
    }

    /**
     * @return ArrayOfRecordRef
     */
    public function getRecordRefs()
    {
      return $this->recordRefs;
    }

    /**
     * @param ArrayOfRecordRef $recordRefs
     * @return \ProgressionWebService\SearchRecordRefsResponse
     */
    public function setRecordRefs($recordRefs)
    {
      $this->recordRefs = $recordRefs;
      return $this;
    }

}
