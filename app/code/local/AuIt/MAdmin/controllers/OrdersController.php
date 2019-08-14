<?php
class AuIt_MAdmin_OrdersController extends Mage_Adminhtml_Controller_Action
{
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

    public function nextAction()
    {

        $this->loadLayout();
		$this->renderLayout();
    }
    public function itemsAction()
    {

    	$id = $this->getRequest()->getParam('id');
    	$order = Mage::getModel('sales/order')->load($id);

    	if (!$order->getId()) {
    		$this->_getSession()->addError($this->__('This order no longer exists.'));
    		$this->_redirect('*/*/');
    		$this->setFlag('', self::FLAG_NO_DISPATCH, true);
    		return false;
    	}
    	Mage::register('sales_order', $order);
    	Mage::register('current_order', $order);

        $this->loadLayout();
		$this->renderLayout();
    }
}
