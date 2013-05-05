<?php

/**
 * Récupère les informations concernant l'url
 * @name Request
 */
class Request
{
    
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
        if(isset($_SERVER['PATH_INFO'])) {
            $this->url = $_SERVER['PATH_INFO'];
        }
        else
        {
            header('Location: '.BASE_URL.DS.'configuration_webPlane1.0/home/');
            exit;
        }
    }
    
    public function getRecModule()
    {
        $Data = spyc_load_file(ROOT.DS.'config'.DS.'routing.yml');
        $routes = $this->findRoute($this->module, $Data);
        if($routes != null)
        {
            $this->nameModule = $routes['resource'];
            return true;
        }
        else
        {
            $ini = new Ini('../config/parameters.ini');
            $var = $ini->return_array();
            if(array_key_exists('DATABASE', $var) && array_key_exists('SITE', $var))
                echo "";
            else 
            {
                header('Location: '.BASE_URL.DS.'configuration_webPlane1.0/home/');
                exit;
            }
        }
    }
    
    /**
     * Permet de retourner un tableau contenant les informations 
     * de la route si elle existe
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
