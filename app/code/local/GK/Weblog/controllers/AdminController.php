<?php

class GK_Weblog_AdminController extends Mage_Adminhtml_Controller_Action {

    protected function _initAction() {
        // load layout, set active menu and breadcrumbs
        $this->loadLayout()
                ->_setActiveMenu('weblog/posts');
        return $this;
    }

    public function indexAction() {
        $this->_initAction();
        $this->_addContent(
                $this->getLayout()
                        ->createBlock('weblog/adminhtml_posts')
        );

        $this->renderLayout();
    }

    public function newAction() {
        // the same form is used to create and edit
        $this->_forward('edit');
    }

    public function editAction() {
        $id = $this->getRequest()->getParam('id', null);
        $model = Mage::getModel('weblog/blogpost');
        if ($id && ctype_digit($id)) {
            $model->load($id);
            if ($model->getId()) {
                $data = Mage::getSingleton('adminhtml/session')->getFormData(true);
                if ($data) {
                    $model->setData($data)->setId($id);
                }
            }
            else {
                Mage::getSingleton('adminhtml/session')->addError(Mage::helper('weblog')->__('No post to edit'));
                $this->_redirect('*/*/');
            }
        }
        Mage::register('form_data', $model);
        $this->_initAction();
        $this->_addContent($this->getLayout()->createBlock('weblog/adminhtml_new'))
                ->_addLeft($this->getLayout()->createBlock('weblog/adminhtml_new_tabs'));
        $this->renderLayout();
    }

    public function saveAction() {
        if ($data = $this->getRequest()->getPost()) {
            $blogpost = Mage::getModel('weblog/blogpost');
            if ($id = $this->getRequest()->getParam('id')) {
                $blogpost->load($id);
            }
            $blogpost->addData($data);

            Mage::getSingleton('adminhtml/session')->setFormData($data);
            $blogpost->addData(array('date'=> date("Y-m-d H:i:s", Mage::getModel('core/date')->timestamp(time()))));
            try {
                $blogpost->save();
                Mage::getSingleton('adminhtml/session')->addSuccess('Saved');
                Mage::getSingleton('adminhtml/session')->setFormData(false);
                $this->_redirect('*/*/');
            }
            catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            }
        }
    }

    public function deleteAction() {
        if ($id = $this->getRequest()->getParam('id')) {
            try {
                $model = Mage::getModel('weblog/blogpost');
                $model->setId($id);
                $model->delete();
                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('weblog')->__('The post has been deleted.'));
                $this->_redirect('*/*/');
                return;
            }
            catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
                return;
            }
        }
        Mage::getSingleton('adminhtml/session')->addError(Mage::helper('adminhtml')->__('No post to delete.'));
        $this->_redirect('*/*/');
    }

}
