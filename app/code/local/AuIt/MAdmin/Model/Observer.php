<?php
class AuIt_MAdmin_Model_Observer
{
    /**
     * Predispath admin action controller
     *
     * @param Varien_Event_Observer $observer
     */
    public function predispatch_start(Varien_Event_Observer $observer)
    {
		if ( Mage::getSingleton('adminhtml/session')->getData('SNM-USE-MOBILE') == 1 )
		{

			Mage::getDesign()->setTheme('layout','snm-mobile');
			Mage::getDesign()->setTheme('template','snm-mobile');
			Mage::getDesign()->setTheme('skin','snm-mobile');

		}

    }
}
