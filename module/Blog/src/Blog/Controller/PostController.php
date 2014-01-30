<?php
/**
 *     author asmalouski
 * 
 */

namespace Blog\Controller;
use Blog\Forms\PostForm;
use Blog\Forms\Filters\PostFilter;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;


class PostController extends AbstractActionController
{
    protected $postsTable;
    
    public function listAction(){
        return new ViewModel(array(
            'posts' => $this->getPostsTable()->fetchAll(),
        ));
    }
    
    public function viewPostAction(){
        
    }
    
    public function viewAction()
    {
     //   $postId = $this->getEvent()->getRouteMatch()->getParam('postId');
        $content = 'Пагоню не спыняе нi боль, нi кроу, нi страх! I над крывiцкiм краем як птах лунае сцяг.';
        $viewObj = new ViewModel(array(
            'title' => 'Основная идея',
            'content' => $content
            
        ));
       $widgetObj = new ViewModel();
       $widgetObj->setTemplate('post/widget');
       $viewObj->addChild($widgetObj, 'widget');
        return $viewObj;
    }
    
    public function addPostAction(){
        $form = new PostForm();
        $request = $this->getRequest();
        if($request->isPost()){
            $form->setData($request->getPost());
            $regFilter = new PostFilter();
            $form->setInputFilter($regFilter->getInputFilter());         
            if($form->isValid()){
                
            }else{
                    
            }
        }
        return new ViewModel(array(
            'form' => $form
        ));
    }
    
    public function editPostAction(){
        $form = new PostForm();
        return new ViewModel(array(
            'form' => $form
        ));
    }
    
    public function removePostAction(){
        
    }
    
    private function getPostsTable(){
         if (!$this->postsTable) {
             $sm = $this->getServiceLocator();
             $this->postsTable = $sm->get('Blog\Models\Posts\PostsTable');
         }
         return $this->postsTable;        
    }
}
