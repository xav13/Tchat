<?php

/**
 * Controller global
 * Socle de construction des pages
 * 
 * @category IP_lib
 * @version 0.0.1
 *
 */
abstract class Controller
{
    /**
     * @var Request
     */
    protected $request;
    
    /**
     * @var Response
     */
    protected $response;
    
    /**
     * @var View
     */
    protected $view;
    
    /**
     * @var Layout
     */
    protected $layout;
    
    /**
     * Désactive le layout
     * @var Booleans
     */
    protected $_disabledLayout = FALSE;
    
    /**
     * Variable indiquant le context de la page
     * @var string
     */
    protected $context = 'html';
    
    /**
     * Constructeur
     * @param Request $request
     * @param Response $response
     */
    
    /**
     * Constructeur
     * @param Request $request
     * @param Response $response
     */
    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
        $this->init();
        $this->switchContext();
        $this->view = new View($this->request->getRoute(), $this->context);
        if ($this->_disabledLayout === FALSE) {
        	$this->layout = new Layout($this->view);
        }
        //$this->view = new View($this->request->getRoute());
        $this->layout = new Layout($this->view);
        if(!empty($_POST)){
        	$this->data = new stdClass();
        	foreach($_POST as $k=>$v){
        		$this->data->$k=$v;
        	}
        }
    }
    public function init(){}
    
    public function switchContext(){
    	$params = $this->request->getParams();
    	if(isset($_SERVER['HTTP_X_REQUESTED_WITH'])){
    		$this->setDisabledLayout();
    		$defaultContext = 'ajax';
    	} else {
    		$defaultContext = 'html';
    	}
    	if(isset($params['context']) && !empty($params['context'])){
    		$this->context = $params['context'];
    	} else {
    		$this->context = $defaultContext;
    	}
    }
    
    /**
     * Permet de charger un model
     **/
    public function loadModel($name,$form=null)
    {
    	if(!isset($this->$name)){
    		$file = MODEL_PATH . DS .$name.'.php';
    		require_once($file);
    		$this->$name = new $name();
    		if(isset($form)){
    			$this->$name->form = new Form();
    			$this->$name->form->data = $this->request->data;
    		}
    	}
    
    }
    
  // abstract public function action();
  
    public function setDisabledLayout($bool = TRUE)
    {
    	$this->_disabledLayout = $bool;
    }
    
    public function __destruct()
    {
        if ($this->_disabledLayout === FALSE) {
            $viewContent = $this->layout->render();
        } else {
            $viewContent = $this->view->render();
        }
        $this->response->setBody($viewContent);
    }
}