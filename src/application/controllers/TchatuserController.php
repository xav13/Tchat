<?php

/**
 * Controller Accueil
 * @author Formateur
 *
 */
class TchatuserController extends Controller
{
    public function action()
    {	
    	$this->loadModel('Message');
    	$this->loadModel('User');

    	$this->view->auth = $this->request->getSession()->getNamespace('auth');
    	$infoUserSession = $this->request->getSession()->getNamespace('auth');
    	
    	$params = $this->request->getParams();
    	$infosUserDest = $this->User->infosUserById($params['id']);
    	
    	$messages = $this->Message->messageConvers($infoUserSession['id'],$infosUserDest['id']);
    	$messages = array_reverse($messages);
    	$this->view->infosUserDest = $infosUserDest;
    	$this->view->messages = $messages;
    }
    public function listeMessages()
    {
    	$this->loadModel('Message');
    	$this->loadModel('User');

    	$this->view->auth = $this->request->getSession()->getNamespace('auth');
    	$infoUserSession = $this->request->getSession()->getNamespace('auth');
    	
    	$params = $this->request->getParams();
    	$infosUserDest = $this->User->infosUserById($params['id']);
    	
    	$messages = $this->Message->messageConvers($infoUserSession['id'],$infosUserDest['id']);
    	$messages = array_reverse($messages);
    	$this->view->infosUserDest = $infosUserDest;
    	$this->view->messages = $messages;
    	
    }
    public function envoyerMessage()
    {
    	
    	$this->loadModel('Message');
    	$this->loadModel('User');
    	
    	$this->view->auth = $this->request->getSession()->getNamespace('auth');
    	$infoUserSession = $this->request->getSession()->getNamespace('auth');
    	
    	$params = $this->request->getParams();
    	$infosUserDest = $this->User->infosUserById($params['id']);
    	
    	$this->Message->sendMessage($infosUserDest['id'],$infoUserSession['id'],addslashes(htmlspecialchars($params['message'])));
    	
    	$messages = $this->Message->messageConvers($infoUserSession['id'],$infosUserDest['id']);
    	$messages = array_reverse($messages);   
    	$this->view->messages = $messages;
    	$this->view->infosUserDest =$infosUserDest;
    }
     
      
}