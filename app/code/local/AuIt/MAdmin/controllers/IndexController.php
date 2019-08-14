<?php
class AuIt_MAdmin_IndexController extends Mage_Adminhtml_Controller_Action
{

	public function preDispatch()
	{
		if ( $this->getRequest()->getActionName() != 'classic' )
			$this->_getSession()->setData('SNM-USE-MOBILE',1);
		else
			$this->_getSession()->setData('SNM-USE-MOBILE',null);
		return parent::preDispatch();
	}
    protected function _initAction()
    {
        // load layout, set active menu and breadcrumbs
        $this->loadLayout();

        return $this;
    }

    /**
     * Index action
     */
    public function indexAction()
    {
    	$this->_redirect('adminhtml/index');
    }
    public function logoutAction()
    {
    	/** @var $adminSession Mage_Admin_Model_Session */
    	$adminSession = Mage::getSingleton('admin/session');
    	$adminSession->unsetAll();
    	$adminSession->getCookie()->delete($adminSession->getSessionName());
    	$adminSession->addSuccess(Mage::helper('adminhtml')->__('You have logged out.'));

    	$this->_redirect('mobile_admin');
    }
    public function logAction()
    {

    	$response = new Varien_Object();
    	$response->setError(true);
    	if (Mage::getSingleton('admin/session')->isLoggedIn()) {
    		$response->setError(false);
    	}

    	$this->getResponse()->setBody($response->toJson());
    	/** @var $adminSession Mage_Admin_Model_Session */

    }
    public function testAction()
    {
    	 $this->_initAction();
    	$this->renderLayout();
    }
    public function aboutusAction()
    {
    	 $this->_initAction();
    	$this->renderLayout();
    }

    public function classicAction()
    {
    	$this->_getSession()->setData('SNM-USE-MOBILE',-1);
    	$this->_redirect('adminhtml/index');
    }
}
