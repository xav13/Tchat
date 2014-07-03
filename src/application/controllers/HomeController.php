<?php

/**
 * Controller Accueil
 * @author Formateur
 *
 */
class HomeController extends Controller
{
    public function action()
    {	
        $this->view->auth = $this->request->getSession()->getNamespace('auth');
    }
    public function inscription()
    {
    	$this->view->auth = $this->request->getSession()->getNamespace('auth');
        $this->loadModel('User'); 
        if($this->request->data){
        	if(($this->User->validates($this->request->data))==1){
        		$this->User->table = "users";
               	$this->User->save($this->request->data);
                echo ('Compte cr�e');
            }else{
                echo ('Erreur dans l\'ajout des donnes'); 
                $this->view->messageerrinsc = $this->User->validates($this->request->data);
            }
        }else{
        	echo('Aucune donn�es a enregistrer');
        }
      }
      public function login()
      {
      	$this->view->auth = $this->request->getSession()->getNamespace('auth');
      	$this->loadModel('User');
      	if($this->request->data){
      		if(($this->User->validates($this->request->data))==1){
      			$this->User->table = "users";
      			$result = $this->User->findByLoginAndPassword($this->request->data->login,$this->request->data->password);//Récupération d'un tableau contenant un enregistrement ou FALSE
        		if (FALSE == $result) {//Test pour savoir si il y a un résultat correspondant à la requète
        			$errMessages[] = 'Login & Password not match';//Ajout d'un message d'erreur
        			$this->view->errMessages = $errMessages;
        		}else {
        			$this->request->getSession()->setNamespace('auth', $result);//Stock des données utilisateur dans les sessions
        			$this->view->auth = $this->request->getSession()->getNamespace('auth');
        		}
      		}else{
      			$this->view->messageerrlog = $this->User->validates($this->request->data);
      		}
      	}else{
      		echo('Aucune donn�es pour se loguer');
      	}
      }
      public function logout()
      {
      	$this->request->getSession()->unsetNamespace('auth');
      	$this->view->auth = false;
      }
}