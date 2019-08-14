<?php
class AuIt_MAdmin_Model_Session extends Mage_Core_Model_Session_Abstract
{
    public function __construct()
    {
        $this->init('auit-mobile-admin');
    }
}
