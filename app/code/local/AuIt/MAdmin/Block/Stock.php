<?php
class AuIt_MAdmin_Block_Stock extends Mage_Adminhtml_Block_Template
{
    public function getProduct()
    {
    	return Mage::registry('search_produt');
    }
    public function getStockFieldValue($field)
    {
    	if ($this->getProduct()->getStockItem()) {
    		return $this->getProduct()->getStockItem()->getDataUsingMethod($field);
    	}
       	return Mage::getStoreConfig(Mage_CatalogInventory_Model_Stock_Item::XML_PATH_ITEM . $field);
    }
    public function getStockOption()
    {
    	if (Mage::helper('catalog')->isModuleEnabled('Mage_CatalogInventory')) {
    		return Mage::getSingleton('cataloginventory/source_stock')->toOptionArray();
    	}
    	return array();
    }
}