<?php
class AuIt_MAdmin_Block_Orders extends Mage_Adminhtml_Block_Template
{
    public function getOrderCollection()
    {
    	$page = $this->getCurrentPage();
    	$limit= ( $page == 1)?10:10;
    	return Mage::Helper('auit_madmin')->getOrderCollection($page,$limit);
    }
    public function getProduct($orderItem)
    {
    	if ( !$orderItem->getProduct() )
    	{
    		$product = Mage::getModel('catalog/product');

    		$product->load($orderItem->getProductId());
    		$orderItem->setProduct($product);
    	}
    	return $orderItem->getProduct();
    }
    public function getProductImg($orderItem)
    {
    	$imageUrl='';
    	try {
    		$imageUrl = ''.$this->getProduct($orderItem)->getImageUrl();
    	}catch ( Exception $e )
    	{

    	}
    	return $imageUrl;
    }
    public function getInfo($order)
    {
    	/* @var $order Mage_Sales_Model_Order */
    	return $order->getBillingAddress()->format('oneline');
    }

    public function getCurrentPage()
    {
    	if ($page = (int) $this->getRequest()->getParam('p')) {
    		return $page;
    	}
    	return 1;
    }
    public function getOrder()
    {
    	return Mage::registry('current_order');

    }
    public function getOrderOptions($_item)
    {
    	/* @var $_items Mage_Sales_Model_Mysql4_Order_Item_Collection */
		$options = @unserialize($_item->getData('product_options'));
    	$result = array();
    	if ($options  ) {
    		if (isset($options['options'])) {
    			$result = array_merge($result, $options['options']);
    		}
    		if (isset($options['additional_options'])) {
    			$result = array_merge($result, $options['additional_options']);
    		}
    		if (!empty($options['attributes_info'])) {
    			$result = array_merge($options['attributes_info'], $result);
    		}
    	}
    	return $result;
    }

}