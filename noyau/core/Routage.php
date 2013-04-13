<?php

class Routage
{
    
    private $url; //Url appelé par l'utilisateur
    private $urlParse; //Url parser
    private $nameModule;
    private $controller; //Controller
    
    function __construct()
    {
        $this->url = $_SERVER['PATH_INFO'];
        $this->urlParse = $this->parse($this->url);
        $this->loadModule();
    }
    
    /*
     * Permet de parser une url
     * @param $url url à parser
     * @return tableau contenant les paramètres
     */
    function parse($url)
    {
        $url = trim($url, DS); //Supprime les slashs en début et en fin de ligne
        $param = explode(DS, $url);
        $valUrl = array(
            'module' => $param[0],
            'controller' => $param[1]
        );
        $valUrl['parametre'] = array_slice($param, 2);
        return $valUrl;
    }
    
    /*
     * Permet de charger le module
     */
    function loadModule()
    {
        //Chargement du fichier qui contient toutes les routes 
        $Data = spyc_load_file(ROOT.DS.'config'.DS.'routing.yml');
        $routes = $this->findRoute($this->urlParse['module'], $Data);
        $this->nameModule = $routes['resource'];
        
        if($routes != null)
        {
            //Chargement du fichier de routing du module
            $routes['resource'] = trim($routes['resource'], DS); //Supprime les slashs en début et en fin de ligne
            $Data = spyc_load_file(ROOT.DS.$routes['resource'].DS.'config'.DS.'routing.yml');
            $controller = $this->findRoute($this->urlParse['controller'], $Data);
            $this->controller = $controller;
        }
    }
    
    /*
     * Permet de retourner un tableau contenant les informations du route si elle existe
     * @param $name_url nom de l'url
     * @param $fileRouting Fichier contenant les routes
     * @return Tableau d'information d'une route
     */
    function findRoute($name_url, $fileRouting)
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
    
    /*
     * Permet d'éxécuter l'action du controller
     * @return Ne retourne rien
     */
    function loadController()
    {
        if($this->controller != null)
        {
            $valCont = $this->parseController($this->controller['controller']);
            require ROOT.DS.$this->nameModule.DS.'controller'.DS.$valCont['fichier'].'.php';
            $cont = new $valCont['fichier']();
            call_user_func_array(array($cont, $valCont['fonction']), $this->urlParse['parametre']);
        }
    }
    
    /*
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
    
    public function getNameModule()
    {
        return $this->nameModule;
    }
}
