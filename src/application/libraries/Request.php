<?php 

/**
 * Objet Request
 * Représente l'entrée de l'application (la requete HTTP qui va declencher l'execution de l'application)
 * 
 * @category IP_lib
 * @version 0.0.1
 * 
 */
class Request
{
    /**
     * URL de la requete
     * @var string
     */
    private $url;
    /**
     * Methode de la requete (GET, POST...)
     * @var string
     */
    private $method;
    /**
     * Parametres de la requete
     * @var array
     */
    private $params = array();
    
    /**
     * Route initialisee vide
     * @var string
     */
    private $route;

    /**
     * Variable qui contient l'objet SESSION
     * @var SESSION
     */
    
    /**
     * 
     * @var object contient les donn�es de $_POST
     */
    public $data = false;
    
    private $session;
    /**
     * Constructeur
     */

    public function __construct()
    {
        $this->url = ltrim($_SERVER['REQUEST_URI'], '/');
        $this->method = $_SERVER['REQUEST_METHOD'];
        $this->params = $_REQUEST;
        if(!empty($_POST)){
        	$this->data = new stdClass();
        	foreach($_POST as $k=>$v){
        		$this->data->$k=$v;
        	}
        }
    }// end of __construct
    
	/**
     * @return the $url
     */
    public function getUrl()
    {
        return $this->url;
    }

	/**
     * @return the $method
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * @return the $params
     */
    public function getParams()
    {
        return $this->params;
    }

	/**
     * @param multitype: $params
     */
    public function setParams(Array $params)
    {
        $this->params = $params;
    }
    
	/**
     * @return the $route
     */
    public function getRoute()
    {
        return $this->route;
    }

	/**
     * @param string $route
     */
    public function setRoute($route)
    {
        $this->route = $route;
    }
    
	/**
     * @return the $session
     */
    public function getSession()
    {
        return $this->session;
    }

	/**
     * @param Session $session
     */
    public function setSession($session)
    {
        $this->session = $session;
        return $this;
    }
    
}// end of Request