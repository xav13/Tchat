<?php

/**
 * Controller Accueil
 * @author Formateur
 *
 */
class RefreshTchatController extends Controller
{
    public function action()
    {	
    	$this->loadModel('Message');
    	$this->loadModel('User');

    	$this->view->auth = $this->request->getSession()->getNamespace('auth');
    	$infoUserSession = $this->request->getSession()->getNamespace('auth');
    	
    	$params = $this->request->getParams();
    	$infosUserDest = $this->User->infosUserById($params['id']);
    	
    	$messages = $this->Message->messageConversLast($infoUserSession['id'],$infosUserDest['id'],$params['last_id_message']);
    	$messages = array_reverse($messages);
    	$this->view->infosUserDest = $infosUserDest;
    	$this->view->messages = $messages;
    }
}