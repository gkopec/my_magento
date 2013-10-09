<?php

/**
 * Catalog view layer model
 *
 * @category    Mage
 * @package     Mage_Catalog
 * @author      Magento Core Team <core@magentocommerce.com>
 */
class Polcode_Helloworld_Model_Layer extends Mage_Catalog_Model_Layer {

    /**
     * Retrieve current layer product collection
     *
     * @return Mage_Catalog_Model_Resource_Eav_Mysql4_Product_Collection
     */
    public function getProductCollection() {
        if (isset($this->_productCollections[$this->getCurrentCategory()->getId()])) {
            $collection = $this->_productCollections[$this->getCurrentCategory()->getId()];
        }
        else {
            $collection = $this->getCurrentCategory()->getProductCollection();

            /* @var $collection Mage_Catalog_Model_Resource_Product_Collection */
            if (Mage::registry('_filts')) {
                foreach(Mage::registry('_filts') as $key=>$filtr) {
                    if (Mage::getModel('eav/config')->getAttribute('catalog_product', $key))
                    {
                       $collection->addAttributeToFilter($key, array('eq' => $filtr));
                    } 
                }
            }

            $this->prepareProductCollection($collection);
            $this->_productCollections[$this->getCurrentCategory()->getId()] = $collection;
        }
        return $collection;
    }
    
    public function getNewProductCollection() {
        if (isset($this->_productCollections[$this->getCurrentCategory()->getId()])) {
            $collection = $this->_productCollections[$this->getCurrentCategory()->getId()];
        }
        else {
            $collection = $this->getCurrentCategory()->getProductCollection();

             $todayStartOfDayDate = Mage::app()->getLocale()->date()
                ->setTime('00:00:00:')
                ->subDay(10)
                ->toString(Varien_Date::DATETIME_INTERNAL_FORMAT);
            $todayEndOfDayDate = Mage::app()->getLocale()->date()
                ->setTime('23:59:59')
                ->toString(Varien_Date::DATETIME_INTERNAL_FORMAT);
            $collection
                ->addAttributeToFilter('created_at', array('or' => array(
                        0 => array('date' => true, 'to' => $todayEndOfDayDate),
                        1 => array('is' => new Zend_Db_Expr('null')))
                        ), 'left')
                ->addAttributeToFilter('created_at', array('or' => array(
                        0 => array('date' => true, 'from' => $todayStartOfDayDate),
                        1 => array('is' => new Zend_Db_Expr('null')))
                        ), 'left')
                ->addAttributeToFilter(
                        array(
                            array('attribute' => 'created_at', 'is' => new Zend_Db_Expr('not null')),
                            array('attribute' => 'created_at', 'is' => new Zend_Db_Expr('not null'))
                        ));
            

            $collection->addAttributeToSort('created_at', 'desc');
            $collection->getSelect()->limit(20);
            $col_clone = clone $collection;
            $this->prepareProductCollection($col_clone);
            
            if ($col_clone->getSize() < 12) {
                $collection->getSelect()->reset('where')->limit(12);
            }
            $this->prepareProductCollection($collection);
            $this->_productCollections[$this->getCurrentCategory()->getId()] = $collection;
        }
        return $collection;
    }

}
