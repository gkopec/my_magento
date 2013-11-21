<?php

class GK_Weblog_Block_Adminhtml_New_Tabs_Form extends Mage_Adminhtml_Block_Widget_Form {

    protected function _prepareForm() {
        $data = array();
        if (Mage::getSingleton('adminhtml/session')->getFormData()) {
            $data = Mage::getSingleton('adminhtml/session')->getFormData(true);
        }
        elseif (Mage::registry('form_data')) {
            $data = Mage::registry('form_data')->getData();
        }
        
        $form = new Varien_Data_Form();
        $this->setForm($form);
        $fieldset = $form->addFieldset('new_form', array('legend' => Mage::helper('weblog')->__('Post details')));

        $fieldset->addField('title', 'text', array(
            'name' => 'title',
            'title' => Mage::helper('weblog')->__('Title'),
            'label' => Mage::helper('weblog')->__('Title'),
            'maxlength' => '100',
            'required' => true,
        ));

        $fieldset->addField('post', 'textarea', array(
            'name' => 'post',
            'title' => Mage::helper('weblog')->__('Post'),
            'label' => Mage::helper('weblog')->__('Post'),
            'style' => 'width: 500px; height: 150px;',
            'required' => true,
        ));

        
        $form->setValues($data);

        return parent::_prepareForm();
    }

}
