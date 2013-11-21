<?php

class GK_Weblog_IndexController extends Mage_Core_Controller_Front_Action {

    public function indexAction()
    {
        $this->loadLayout();
        $this->renderLayout();
    }
    
    public function testModelAction() {
        $params = $this->getRequest()->getParams();
        $params['id'] = 1;
        $blogpost = Mage::getModel('weblog/blogpost');
        echo("Loading the blogpost with an ID of " . $params['id']);
        $blogpost->load($params['id']);
        $data = $blogpost->getData();
        Mage::Log($data);
        var_dump($data);
        var_dump($data = $blogpost->getOrigData());
    }

    public function createNewPostAction() {
        $blogpost = Mage::getModel('weblog/blogpost');
        $blogpost->setTitle('Tytuł posta generowanego metodą createNewPost');
        $blogpost->setPost('Lorem ipsum.....');
        $blogpost->save();
        echo 'post created';
    }
}