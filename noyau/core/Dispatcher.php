<?php

/**
 * Redirection des url
 * @name Dispatcher
 */
class Dispatcher
{
    
    /**
     * @var (Request())
     * @desc Instance de la classe Request()
     */
    private $request;
    
    /**
     * @var (String)
     * @desc Nom du module
     */
    public $nameModule;
    
    public function __construct()
    {
        $this->request = new Request();
        Routage::parse($this->request->getUrl(), $this->request);
        $this->loadController();
    }
    
    /**
     * Permet de charger le controller
     * @name Dispatcher::loadController()
     */
    public function loadController()
    {
        $controller = $this->loadModule();
        if($controller != null)
        {
            $valCont = $this->parseController($controller['controller']);
            require ROOT.DS.$this->request->getNameModule().DS.'controller'.DS.$valCont['fichier'].'.php';
            $cont = new $valCont['fichier']();
            call_user_func_array(array($cont, $valCont['fonction']), $this->request->getParametres());
        }
    }
    
    /**
     * Permet de récupérer les informations de routing d'un module
     */
    function loadModule()
    {
        
        $this->request->getRecModule();
        
        if($this->request->getNameModule() != null)
        {
            //Chargement du fichier de routing du module
            $routes['resource'] = trim($this->request->getNameModule(), DS); //Supprime les slashs en début et en fin de ligne
            $Data = spyc_load_file(ROOT.DS.$this->request->getNameModule().DS.'config'.DS.'routing.yml');
            $controller = $this->findRoute($this->request->getController(), $Data);
            return $controller;
        }
        return null;
    }
    
    /**
     * Permet de parser le controller
     * @param $controller Controller à parser
     * @return Tableau contenant le controller parser
     */
    function parseController($controller)
    {
        $param = explode(':', $controller);
        $valCont = array(
            'fichier' => $param[0],
            'fonction' => $param[1]
        );
        return $valCont;
    }
    
    /**
     * Permet de retourner un tableau contenant les informations du route si elle existe
     * @param $name_url nom de l'url
     * @param $fileRouting Fichier contenant les routes
     * @return Tableau d'information d'une route
     */
    public function findRoute($name_url, $fileRouting)
    {
        foreach($fileRouting as $val)
        {
            if($name_url == $val['name_url'])
            {
                $routes = array_slice($val, 0);
                return $routes;
            }
        }
        return null;
    }
    
}
