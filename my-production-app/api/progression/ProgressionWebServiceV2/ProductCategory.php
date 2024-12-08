<?php

namespace ProgressionWebService;

class ProductCategory extends Record
{

    /**
     * @var RecordRef $ProductCategoryParentRef
     */
    protected $ProductCategoryParentRef = null;

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
     * @return RecordRef
     */
    public function getProductCategoryParentRef()
    {
      return $this->ProductCategoryParentRef;
    }

    /**
     * @param RecordRef $ProductCategoryParentRef
     * @return \ProgressionWebService\ProductCategory
     */
    public function setProductCategoryParentRef($ProductCategoryParentRef)
    {
      $this->ProductCategoryParentRef = $ProductCategoryParentRef;
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
     * @return \ProgressionWebService\ProductCategory
     */
    public function setLabel($Label)
    {
      $this->Label = $Label;
      return $this;
    }

}
