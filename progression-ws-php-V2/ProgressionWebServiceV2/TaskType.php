<?php

namespace ProgressionWebService;

class TaskType extends Type
{

    /**
     * @var ArrayOfRecord $Priorities
     */
    protected $Priorities = null;

    /**
     * @var RecordRef $WorkflowRef
     */
    protected $WorkflowRef = null;

    /**
     * @var RecordRef $TaskItemTypeRef
     */
    protected $TaskItemTypeRef = null;

    /**
     * @var string $CodePrefix
     */
    protected $CodePrefix = null;

    /**
     * @var string $Icon
     */
    protected $Icon = null;

    /**
     * @var boolean $ProductBilling
     */
    protected $ProductBilling = null;

    /**
     * @var boolean $QuantityConfirm
     */
    protected $QuantityConfirm = null;

    /**
     * @var string $PropertiesDisplayOrder
     */
    protected $PropertiesDisplayOrder = null;

    /**
     * @var string $OfflineTemplate
     */
    protected $OfflineTemplate = null;

    /**
     * @var string $OfflineTemplateCss
     */
    protected $OfflineTemplateCss = null;

    /**
     * @var string $OfflineTemplatePreprocessor
     */
    protected $OfflineTemplatePreprocessor = null;

    /**
     * @param int $Id
     * @param string $UID
     * @param string $ExternalId
     * @param \DateTime $removed
     * @param anySimpleType $updated
     * @param anySimpleType $created
     * @param string $Label
     * @param boolean $mobileAllowCreate
     * @param boolean $defaultType
     * @param boolean $allowCreate
     * @param ArrayOfRecord $Priorities
     * @param RecordRef $WorkflowRef
     * @param string $CodePrefix
     * @param string $Icon
     * @param boolean $ProductBilling
     * @param boolean $QuantityConfirm
     * @param string $PropertiesDisplayOrder
     * @param string $OfflineTemplate
     * @param string $OfflineTemplateCss
     * @param string $OfflineTemplatePreprocessor
     */
    public function __construct($Id = null, $UID = null, $ExternalId = null, \DateTime $removed = null, $updated = null, $created = null, $Label = null, $mobileAllowCreate = null, $defaultType = null, $allowCreate = null, $Priorities = null, $WorkflowRef = null, $CodePrefix = null, $Icon = null, $ProductBilling = null, $QuantityConfirm = null, $PropertiesDisplayOrder = null, $OfflineTemplate = null, $OfflineTemplateCss = null, $OfflineTemplatePreprocessor = null)
    {
      parent::__construct($Id, $UID, $ExternalId, $removed, $updated, $created, $Label, $mobileAllowCreate, $defaultType, $allowCreate);
      $this->Priorities = $Priorities;
      $this->WorkflowRef = $WorkflowRef;
      $this->CodePrefix = $CodePrefix;
      $this->Icon = $Icon;
      $this->ProductBilling = $ProductBilling;
      $this->QuantityConfirm = $QuantityConfirm;
      $this->PropertiesDisplayOrder = $PropertiesDisplayOrder;
      $this->OfflineTemplate = $OfflineTemplate;
      $this->OfflineTemplateCss = $OfflineTemplateCss;
      $this->OfflineTemplatePreprocessor = $OfflineTemplatePreprocessor;
    }

    /**
     * @return ArrayOfRecord
     */
    public function getPriorities()
    {
      return $this->Priorities;
    }

    /**
     * @param ArrayOfRecord $Priorities
     * @return \ProgressionWebService\TaskType
     */
    public function setPriorities($Priorities)
    {
      $this->Priorities = $Priorities;
      return $this;
    }

    /**
     * @return RecordRef
     */
    public function getWorkflowRef()
    {
      return $this->WorkflowRef;
    }

    /**
     * @param RecordRef $WorkflowRef
     * @return \ProgressionWebService\TaskType
     */
    public function setWorkflowRef($WorkflowRef)
    {
      $this->WorkflowRef = $WorkflowRef;
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
     * @return \ProgressionWebService\TaskType
     */
    public function setTaskItemTypeRef($TaskItemTypeRef)
    {
      $this->TaskItemTypeRef = $TaskItemTypeRef;
      return $this;
    }

    /**
     * @return string
     */
    public function getCodePrefix()
    {
      return $this->CodePrefix;
    }

    /**
     * @param string $CodePrefix
     * @return \ProgressionWebService\TaskType
     */
    public function setCodePrefix($CodePrefix)
    {
      $this->CodePrefix = $CodePrefix;
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
     * @return \ProgressionWebService\TaskType
     */
    public function setIcon($Icon)
    {
      $this->Icon = $Icon;
      return $this;
    }

    /**
     * @return boolean
     */
    public function getProductBilling()
    {
      return $this->ProductBilling;
    }

    /**
     * @param boolean $ProductBilling
     * @return \ProgressionWebService\TaskType
     */
    public function setProductBilling($ProductBilling)
    {
      $this->ProductBilling = $ProductBilling;
      return $this;
    }

    /**
     * @return boolean
     */
    public function getQuantityConfirm()
    {
      return $this->QuantityConfirm;
    }

    /**
     * @param boolean $QuantityConfirm
     * @return \ProgressionWebService\TaskType
     */
    public function setQuantityConfirm($QuantityConfirm)
    {
      $this->QuantityConfirm = $QuantityConfirm;
      return $this;
    }

    /**
     * @return string
     */
    public function getPropertiesDisplayOrder()
    {
      return $this->PropertiesDisplayOrder;
    }

    /**
     * @param string $PropertiesDisplayOrder
     * @return \ProgressionWebService\TaskType
     */
    public function setPropertiesDisplayOrder($PropertiesDisplayOrder)
    {
      $this->PropertiesDisplayOrder = $PropertiesDisplayOrder;
      return $this;
    }

    /**
     * @return string
     */
    public function getOfflineTemplate()
    {
      return $this->OfflineTemplate;
    }

    /**
     * @param string $OfflineTemplate
     * @return \ProgressionWebService\TaskType
     */
    public function setOfflineTemplate($OfflineTemplate)
    {
      $this->OfflineTemplate = $OfflineTemplate;
      return $this;
    }

    /**
     * @return string
     */
    public function getOfflineTemplateCss()
    {
      return $this->OfflineTemplateCss;
    }

    /**
     * @param string $OfflineTemplateCss
     * @return \ProgressionWebService\TaskType
     */
    public function setOfflineTemplateCss($OfflineTemplateCss)
    {
      $this->OfflineTemplateCss = $OfflineTemplateCss;
      return $this;
    }

    /**
     * @return string
     */
    public function getOfflineTemplatePreprocessor()
    {
      return $this->OfflineTemplatePreprocessor;
    }

    /**
     * @param string $OfflineTemplatePreprocessor
     * @return \ProgressionWebService\TaskType
     */
    public function setOfflineTemplatePreprocessor($OfflineTemplatePreprocessor)
    {
      $this->OfflineTemplatePreprocessor = $OfflineTemplatePreprocessor;
      return $this;
    }

}
