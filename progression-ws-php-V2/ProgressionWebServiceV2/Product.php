<?php

namespace ProgressionWebService;

class Product extends Record
{

    /**
     * @var ArrayOfRecord $RelatedProducts
     */
    protected $RelatedProducts = null;

    /**
     * @var RecordRef $TaskItemTypeRef
     */
    protected $TaskItemTypeRef = null;

    /**
     * @var RecordRef $ProductImageRef
     */
    protected $ProductImageRef = null;

    /**
     * @var RecordRef $TypeRef
     */
    protected $TypeRef = null;

    /**
     * @var RecordRef $ProductCategoryRef
     */
    protected $ProductCategoryRef = null;

    /**
     * @var string $Label
     */
    protected $Label = null;

    /**
     * @var string $code
     */
    protected $code = null;

    /**
     * @var string $description
     */
    protected $description = null;

    /**
     * @var float $Price
     */
    protected $Price = null;

    /**
     * @var boolean $Taxable
     */
    protected $Taxable = null;

    /**
     * @param int $Id
     * @param string $UID
     * @param string $ExternalId
     * @param \DateTime $removed
     * @param anySimpleType $updated
     * @param anySimpleType $created
     * @param string $Label
     * @param string $code
     * @param string $description
     * @param float $Price
     * @param boolean $Taxable
     */
    public function __construct($Id = null, $UID = null, $ExternalId = null, \DateTime $removed = null, $updated = null, $created = null, $Label = null, $code = null, $description = null, $Price = null, $Taxable = null)
    {
      parent::__construct($Id, $UID, $ExternalId, $removed, $updated, $created);
      $this->Label = $Label;
      $this->code = $code;
      $this->description = $description;
      $this->Price = $Price;
      $this->Taxable = $Taxable;
    }

    /**
     * @return ArrayOfRecord
     */
    public function getRelatedProducts()
    {
      return $this->RelatedProducts;
    }

    /**
     * @param ArrayOfRecord $RelatedProducts
     * @return \ProgressionWebService\Product
     */
    public function setRelatedProducts($RelatedProducts)
    {
      $this->RelatedProducts = $RelatedProducts;
      return $this;
    }

    /**
     * @return RecordRef
     */
    public function getTaskItemTypeRef()
    {
      return $this->TaskItemTypeRef;
    }

    /**
     * @param RecordRef $TaskItemTypeRef
     * @return \ProgressionWebService\Product
     */
    public function setTaskItemTypeRef($TaskItemTypeRef)
    {
      $this->TaskItemTypeRef = $TaskItemTypeRef;
      return $this;
    }

    /**
     * @return RecordRef
     */
    public function getProductImageRef()
    {
      return $this->ProductImageRef;
    }

    /**
     * @param RecordRef $ProductImageRef
     * @return \ProgressionWebService\Product
     */
    public function setProductImageRef($ProductImageRef)
    {
      $this->ProductImageRef = $ProductImageRef;
      return $this;
    }

    /**
     * @return RecordRef
     */
    public function getTypeRef()
    {
      return $this->TypeRef;
    }

    /**
     * @param RecordRef $TypeRef
     * @return \ProgressionWebService\Product
     */
    public function setTypeRef($TypeRef)
    {
      $this->TypeRef = $TypeRef;
      return $this;
    }

    /**
     * @return RecordRef
     */
    public function getProductCategoryRef()
    {
      return $this->ProductCategoryRef;
    }

    /**
     * @param RecordRef $ProductCategoryRef
     * @return \ProgressionWebService\Product
     */
    public function setProductCategoryRef($ProductCategoryRef)
    {
      $this->ProductCategoryRef = $ProductCategoryRef;
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
     * @return \ProgressionWebService\Product
     */
    public function setLabel($Label)
    {
      $this->Label = $Label;
      return $this;
    }

    /**
     * @return string
     */
    public function getCode()
    {
      return $this->code;
    }

    /**
     * @param string $code
     * @return \ProgressionWebService\Product
     */
    public function setCode($code)
    {
      $this->code = $code;
      return $this;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
      return $this->description;
    }

    /**
     * @param string $description
     * @return \ProgressionWebService\Product
     */
    public function setDescription($description)
    {
      $this->description = $description;
      return $this;
    }

    /**
     * @return float
     */
    public function getPrice()
    {
      return $this->Price;
    }

    /**
     * @param float $Price
     * @return \ProgressionWebService\Product
     */
    public function setPrice($Price)
    {
      $this->Price = $Price;
      return $this;
    }

    /**
     * @return boolean
     */
    public function getTaxable()
    {
      return $this->Taxable;
    }

    /**
     * @param boolean $Taxable
     * @return \ProgressionWebService\Product
     */
    public function setTaxable($Taxable)
    {
      $this->Taxable = $Taxable;
      return $this;
    }

}
