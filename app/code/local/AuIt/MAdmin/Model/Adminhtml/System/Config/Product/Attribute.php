<?php
class AuIt_MAdmin_Model_Adminhtml_System_Config_Product_Attribute
{
    protected $_options;
	protected function _getProductAttributes()
    {
    	$hash=array();
        //$allowedAttributes=array('date','price','boolean','text','textarea','select','multiselect','media_image');
        $allowedAttributes=array('boolean','select','multiselect','text','textarea');
        $allowedAttributes=array('text','textarea');
        $collection = Mage::getResourceModel('catalog/product_attribute_collection')
            ->addVisibleFilter();
        $hashOpt=array();
    	foreach ( $collection as $attr )
    	{
            $code = $attr->getAttributeCode();
            $type = $attr->getFrontendInput();
            if (!in_array($type, $allowedAttributes) /*|| $attr->getFrontendInput() == 'hidden'*/) {
                continue;
            }
    		$hash[$attr->getAttributeCode()]=$attr->getFrontendLabel();
    	}
    	asort($hash);
    	return $hash;
    }
    public function toOptionArray()
    {
        if (!$this->_options) {
            $this->_options = $this->_getProductAttributes();
            array_unshift($this->_options, array('value'=> '', 'label'=> Mage::helper('adminhtml')->__('-- Please Select --')));
        }
        return $this->_options;
    }
}
