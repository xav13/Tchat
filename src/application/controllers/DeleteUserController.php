<?php

/**
 * Controller Accueil
 * @author Formateur
 *
 */
class DeleteUserController extends Controller
{
    public function action()
    {	
    	$params = $this->request->getParams();
    	if (isset($params['id']) && !empty($params['id'])) {
	        $this->loadModel('User');
	    	$this->view->auth = $this->request->getSession()->getNamespace('auth');
	        $params = $this->request->getParams();
	        $infosUser = $this->User->infosUserById($params['id']);
	
	        $result = $this->User->deleteUser($infosUser['id']);
	        $this->view->result = $result;
	        $this->view->infosUser = $infosUser;
    	}
    }

}