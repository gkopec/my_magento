<?php

class GK_Weblog_Block_Adminhtml_Posts_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct(){
        parent::__construct();
        $this->setId('postsGrid');
         $this->_controller = 'weblog';
        //$this->setSaveParametersInSession(true);
    }
    
    protected function _prepareCollection() {
        $collection = Mage::getModel('weblog/blogpost')->getCollection();
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }
    
    protected function _prepareColumns() {
        $this->addColumn('id', array(
            'header'    => Mage::helper('weblog')->__('ID'),
            'align'     => 'right',
            'width'     => '10px',
            'index'     => 'id'
        ));
        $this->addColumn('title', array(
            'header'    => Mage::helper('weblog')->__('Title'),
            'align'     => 'left',
            'width'     => '100px',
            'index'     => 'title'
        ));
        $this->addColumn('post', array(
            'header'    => Mage::helper('weblog')->__('Post'),
            'align'     => 'left',
            'index'     => 'post'
        ));
        $this->addColumn('date', array(
            'header'    => Mage::helper('weblog')->__('Date'),
            'align'     => 'left',
            'index'     => 'date'
        ));
        
        return parent::_prepareColumns();
    }
    
    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', array('id' => $row->getId()));
    }
}