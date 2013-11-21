<?php

class GK_Weblog_Block_Adminhtml_Posts extends Mage_Adminhtml_Block_Widget_Grid_Container {

    public function __construct() {

        $this->_controller = 'adminhtml_posts';
        $this->_blockGroup = 'weblog';
        $this->_headerText = Mage::helper('weblog')->__('Weblog posts');
        parent::__construct();
    }

}