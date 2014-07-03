<?php 

/**
 * Objet View
 * Affiche le resultat d'une execution MVC
 * 
 * @category IP_lib
 * @version 0.0.1
 *
 */
class View
{
    /**
     * @var string
     */
    private $file;
    
    /**
     * @var string
     */
    private $route;
    
    /**
     * @var string
     */
    private $title;
    
    /**
     * @var string
     */
    private $desc;
    
    public function __construct($route, $context = 'html')
    {
        if($context != 'html'){
            $this->file = VIEW_PATH . DS . $route . '.' . $context . '.phtml';
        } else {
            $this->file = VIEW_PATH . DS . $route . '.phtml';
        }
        
        $this->route = $route;
    }
    
    public function render()
    {
        ob_start();
        require $this->file;
        return ob_get_clean();
    }
    
	/**
     * @return the $title
     */
    public function getTitle()
    {
        return $this->title;
    }

	/**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }
	/**
     * @return the $desc
     */
    public function getDesc()
    {
        return $this->desc;
    }

	/**
     * @param string $desc
     */
    public function setDesc($desc)
    {
        $this->desc = $desc;
    }
	/**
     * @return the $route
     */
    public function getRoute()
    {
        return $this->route;
    }
}