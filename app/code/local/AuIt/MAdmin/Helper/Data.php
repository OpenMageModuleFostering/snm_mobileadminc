<?php
class AuIt_MAdmin_Helper_Data extends Mage_Core_Helper_Abstract
{
	static $_sortField;
	protected $_orders;
	public function sortBy(&$items,$field)
	{
		self::$_sortField=$field;
		$oldValue = setlocale ( LC_COLLATE   , Mage::app()->getLocale()->getLocaleCode().'.UTF-8' );
		uasort($items, array($this,'mystrcoll')) ;
		return $this;
	}
	static function mystrcoll($item1, $item2)
	{
		return strcoll($item1[self::$_sortField], $item2[self::$_sortField]);
	}

	public function getOrderCollection($page=1,$limit=15)
	{
		if ( !$this->_orders  )
		{
			$collection = Mage::getResourceModel('sales/order_collection')
			//->addFieldToFilter('customer_id', $this->getCustomerId())
			//->addFieldToFilter('store_id', array('in' => $storeIds))
			->addAttributeToSelect('*')
			->setOrder('created_at', 'desc')


	//		$collection = Mage::getResourceModel('reports/order_collection')
		//	->addItemCountExpr()
			//->joinCustomerName('customer')
			//$collection->addRevenueToSelect(true);
			->setPageSize((int) $limit)
			->setCurPage((int)  $page)
	//		->load();
			;
			$this->_orders = $collection;
		}
		return $this->_orders;
	}
}
