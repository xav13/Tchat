<?php

/**
 * Controller Accueil
 * @author Formateur
 *
 */
class TchatController extends Controller
{
    public function action()
    {	
        $this->view->auth = $this->request->getSession()->getNamespace('auth');
        $this->loadModel('User');
        
        $infoUserSession = $this->request->getSession()->getNamespace('auth');
        $this->view->usersToSend = $this->User->getUsersToSend($infoUserSession['login']);
    }
    public function listeMessages()
    {
    	$this->loadModel('Message');
    	$this->loadModel('User');

    	$this->view->auth = $this->request->getSession()->getNamespace('auth');
    	$infoUserSession = $this->request->getSession()->getNamespace('auth'); 
    	$messagesUser = $this->Message->messagesUser($infoUserSession['id']);
    	$this->view->messages = $messagesUser;
    	$this->view->usersToSend = $this->User->getUsersToSend($infoUserSession['login']);    	
    }
    public function listeUsers()
    {
    	$this->loadModel('User');
    
    	$this->view->auth = $this->request->getSession()->getNamespace('auth');
    	$infoUserSession = $this->request->getSession()->getNamespace('auth');
    	$this->view->usersToSend = $this->User->getUsersToSend($infoUserSession['login']);
    	$this->view->afflisteUsers = true;
		
    }
    public function envoyerMessage()
    {
    	$this->loadModel('Message');
    	$this->loadModel('User');
		
    	$this->view->auth = $this->request->getSession()->getNamespace('auth');
    	$infoUserSession = $this->request->getSession()->getNamespace('auth');
    	$this->view->usersToSend = $this->User->getUsersToSend($infoUserSession['login']);
    	//$messagesUser = $this->Message->messagesUser($infoUserSession['id']);
    	//$this->view->messages = $messagesUser;
    	$params = $this->request->getParams();
		$this->Message->sendMessage($params['iddest'],$infoUserSession['id'],addslashes(htmlspecialchars($params['message'])));	
    } 
      
}