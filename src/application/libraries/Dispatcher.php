<?php 

/**
 * Objet Dispatcher
 * Declenche, a partir d'un objet request "routÃ©", l'execution de la couche MVC correspondante
 * Il peuple ensuite l'objet Response avec le resultat genere (headers eventuels, body)
 * 
 * @category IP_lib
 * @version 0.0.1
 *
 */

class Dispatcher
{
    /**
     * @var Request
     */
    private $request;
    
    /**
     * @var Response
     */
    private $response;
    
    /**
     * Constructeur
     * @param Request $request
     * @param Response $response
     */
    public function __construct(Request $request, Response $response)
    {
    	$this->request = $request;
    	$this->response = $response;
    }
    
    /**
     * Dispatch
     * Determine a partir de la route contenue dans la request le nom du controller a executer 
     * puis execurte ce controller
     */
    public function dispatch()
    {
        $controllerName = ucfirst($this->request->getRoute()) . 'Controller';
        $controllerFile = $controllerName . '.php';
        
        $params = $this->request->getParams();
        
        require_once CONTROLLER_PATH . DS . $controllerFile;
        // Instanciation dynamique du controller
        $controller = new $controllerName($this->request, $this->response);
        
    	if (isset($params['action'])){
        	$action = $params['action'];
        }else{
            $action='action';
        }
        if(method_exists($controllerName, $action)){
            $controller->$action();  // Si la méthode demandée en paramètre(?action=???) existe on appellera celle ci
        }else{
            $controller->action();  // Appel de la fonction par default
        }
    }
}