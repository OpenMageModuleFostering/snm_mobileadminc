<?php
class AuIt_MAdmin_StockController extends Mage_Adminhtml_Controller_Action
{
	const MAX_QTY_VALUE = 99999999.9999; // see Mage_Adminhtml_Catalog_ProductController
    protected function _getSession()
    {
        return Mage::getSingleton('adminhtml/session');
    }
	public function preDispatch()
	{
		if ( $this->_getSession()->getData('SNM-USE-MOBILE') != -1 )
			$this->_getSession()->setData('SNM-USE-MOBILE',1);
		return parent::preDispatch();
	}
	public function indexAction()
    {
        $this->loadLayout();
		$this->renderLayout();
    }
	public function searchAction()
    {
    	if ( $searchvalue = $this->getRequest()->getParam('searchvalue')  )
    	{
    		$product = Mage::getModel('catalog/product')->loadByAttribute(Mage::getStoreConfig('auit_madmin/stock/attribute'),$searchvalue);
    		if ( $product )
    		{
    			$product = Mage::getModel('catalog/product')->load($product->getId());
    			if ( $product->getId() )
    				Mage::register('search_produt', $product);
    			else
    				$this->_getSession()->addError($this->__('No records found.'));
    		}else
    			$this->_getSession()->addError($this->__('No records found.'));
    	}
    	$this->_forward('index');
    }
    public function saveAction()
    {
    	if ( $data = $this->getRequest()->getParam('product') )
    	{
    		if ( $pid = $this->getRequest()->getParam('product_id') )
    		{
    			$product = Mage::getModel('catalog/product')->load($pid);
    			if ( $product->getId()  )
    			{
    				if ( isset($data['stock_data']) )
    				{
    					$this->_filterStockData($data['stock_data']);
    				}

    				$product->addData($data);
    				try {
    					$product->save();
    					$productId = $product->getId();
    					$this->_getSession()->addSuccess($this->__('The product has been saved.'));
    				} catch (Mage_Core_Exception $e) {
    					$this->_getSession()->addError($e->getMessage());
    					$redirectBack = true;
    				} catch (Exception $e) {
    					Mage::logException($e);
    					$this->_getSession()->addError($e->getMessage());
    					$redirectBack = true;
    				}

    			}
    		}
    	}
    	$this->_forward('index');
    }
    protected function _filterStockData(&$stockData) {


    	if (!isset($stockData['use_config_manage_stock'])) {
    		$stockData['use_config_manage_stock'] = 0;
    	}
    	if (isset($stockData['qty']) && (float)$stockData['qty'] > self::MAX_QTY_VALUE) {
    		$stockData['qty'] = self::MAX_QTY_VALUE;
    	}
    	if (isset($stockData['min_qty']) && (int)$stockData['min_qty'] < 0) {
    		$stockData['min_qty'] = 0;
    	}
    	if (!isset($stockData['is_decimal_divided']) || $stockData['is_qty_decimal'] == 0) {
    		$stockData['is_decimal_divided'] = 0;
    	}
    }

}
