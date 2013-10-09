<?php

class MyModule_Weblog_IndexController extends Mage_Core_Controller_Front_Action {

    public function testModelAction() {
        $params = $this->getRequest()->getParams();
        $params['id'] = 1;
        $blogpost = Mage::getModel('weblog/blogpost');
        echo("Loading the blogpost with an ID of " . $params['id']);
        $blogpost->load($params['id']);
        $data = $blogpost->getData();
        var_dump($data);
        var_dump($data = $blogpost->getOrigData());
    }

    public function createNewPostAction() {
        $blogpost = Mage::getModel('weblog/blogpost');
        $blogpost->setTitle('Code Post!');
        $blogpost->setPost('This post was created from code!');
        $blogpost->save();
        echo 'post created';
    }

    public function showAllBlogPostsAction() {
        $posts = Mage::getModel('weblog/blogpost')->getCollection();
        foreach ($posts as $blog_post) {
            echo '<h3>' . $blog_post->getTitle() . '</h3>';
            echo nl2br($blog_post->getPost());
        }
    }

}