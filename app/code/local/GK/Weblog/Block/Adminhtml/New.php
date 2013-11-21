<?php

class GK_Weblog_Block_Adminhtml_New extends Mage_Adminhtml_Block_Widget_Form_Container {

    public function __construct() {
        parent::__construct();
        $this->_controller = 'adminhtml';
        $this->_blockGroup = 'weblog';
        $this->_mode = 'new';
    }

    public function getHeaderText() {
        if (Mage::registry('form_data') && Mage::registry('form_data')->getId())
        {
            return Mage::helper('weblog')->__('Edit Post "%s"', $this->htmlEscape(Mage::registry('form_data')->getTitle()));
        } else {
            return Mage::helper('weblog')->__('Add New Post');
        }
    }

}

?>
