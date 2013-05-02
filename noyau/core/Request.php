<?php

/**
 * Récupère les informations concernant l'url
 * @name Request
 */
class Request
{
    
    /**
     * @var (String)
     * @desc Url appelé par l'utilisateur
     */
    private $url;
    private $module;
    private $controller;
    private $parametres;
    private $nameModule;
    
    /**
     * Constructeur
     * @name Request::__construct()
     * @return void
     */
    public function __construct()
    {
        $this->url = $_SERVER['PATH_INFO'];
    }
    
    public function getRecModule()
    {
        $Data = spyc_load_file(ROOT.DS.'config'.DS.'routing.yml');
        $routes = $this->findRoute($this->module, $Data);
        $this->nameModule = $routes['resource'];
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
    
    /**
     * Retourne la variable url
     * @name Request::getUrl()
     * @return $url
     */
    public function getUrl()
    {
        return $this->url;
    }
    
    /**
     * Retourne la variable $module
     * @name Request::getModule()
     * @return $module
     */
    public function getModule()
    {
        return $this->module;
    }
    
    /**
     * Retourne la variable $nameModule
     * @name Request::getNameModule()
     * @return $nameModule
     */
    public function getNameModule()
    {
        return $this->nameModule;
    }
    
    /**
     * Retourne la variable $parametres
     * @name Request::getParametres()
     * @return $parametres
     */
    public function getParametres()
    {
        return $this->parametres;
    }
    
    /**
     * Retourne la variable $controller
     * @name Request::getController()
     * @return $controller
     */
    public function getController()
    {
        return $this->controller;
    }
    
    /**
     * Modification de la variable module
     * @name Request::setModule()
     * @return void
     */
    public function setModule($module)
    {
        $this->module = $module;
    }
    
    /**
     * Modification de la variable controller
     * @name Request::setController()
     * @return void
     */
    public function setController($controller)
    {
        $this->controller = $controller;
    }
    
    /**
     * Modification de la variable parametres
     * @name Request::setParametres()
     * @return void
     */
    public function setParametres($parametres)
    {
        $this->parametres = $parametres;
    }
}
