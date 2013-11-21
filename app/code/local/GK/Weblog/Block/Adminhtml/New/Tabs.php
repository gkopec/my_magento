<?php

class GK_Weblog_Block_Adminhtml_New_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{
    public function __construct() {
        parent::__construct();
        $this->setId('tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(Mage::helper('weblog')->__('Post information'));
    }
    
    public function _beforeToHtml() {
        $this->addTab('form_section', array(
            'label'     => Mage::helper('weblog')->__('Post info'),
            'title'     => Mage::helper('weblog')->__('Post info'),
            'content'   => $this->getLayout()->createBlock('weblog/adminhtml_new_tabs_form')->toHtml(),
        ));
        return parent::_beforeToHtml();
    }
    
}

