<?php

class MyModule_Weblog_Model_Mysql4_Blogpost extends Mage_Core_Model_Mysql4_Abstract
{
    public function _construct() {
        $this->_init('weblog/blogpost', 'blogpost_id');
    }
}