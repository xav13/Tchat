<?php

/**
 * Controller Accueil
 * @author Xavier
 *
 */
class ManagerController extends Controller
{
    public function action()
    {	
        $this->view->auth = $this->request->getSession()->getNamespace('auth');
        $this->loadModel('User');
        $users = $this->User->FetchAll();  
        $this->view->users = $users;    
    }
    public function logout()
    {
     	$this->request->getSession()->unsetNamespace('auth');
      	$this->view->auth = false;
    }
}