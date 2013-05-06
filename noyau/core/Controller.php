<?php

class Controller
{
    
    private $variables;

    /**
    * Fonction qui permet de charger une vue avec des paramètres
    **/
    function renderView($view, $variables = null)
    {
        Twig_Autoloader::register();
        $loader = new Twig_Loader_Filesystem(ROOT.DS);
        $twig = new Twig_Environment($loader, array(
            'cache' => false 
        ));;
        $twig->addGlobal('twii', new Twii());
        $twig->addGlobal('page', new Page());
        if($variables == null)
            echo $twig->render($view);
        else
            echo $twig->render($view, $variables);
        /*if(is_array($variables))
        {
            foreach ($variables as $key => $value) {
                $this->variables[$key] = $value;
            }
            print_r($this->variables);
        }
        extract($this->variables);
        $request = new Request();
        Routage::parse($request->getUrl(), $request);
        Routage::parse($request->getRecModule(), $request);
        $view = ROOT.DS.$request->getNameModule().DS.'views'.DS.$view;
        $view2 = ROOT.DS.$request->getNameModule().DS.'views'.DS.'vues_test.php';
        require($view2);
        require($view);*/
    }

    /**
    * Permet d'appeller un controller depuis une vue 
    **/
    public function request($fonction)
    {
        $param = explode(':', $fonction);
        $fichRouting = spyc_load_file(ROOT.DS.'config'.DS.'routing.yml');
        $addressModule = $fichRouting[$param[0]]['resource'];
        require_once ROOT.DS.$addressModule.DS.'controller'.DS.$param[1].'.php';
        $ini = new $param[1]();
        $ini->$param[2]();

    }  

    /**
    * Permet de charger un controller depuis un controller
    * @param String $controller name_module:name_controller:name_function
    * @return header
    **/
    public function header($controller)
    {
        $param = explode(':', $controller);
        $fichRouting = spyc_load_file(ROOT.DS.'config'.DS.'routing.yml');
        $nameModule = $fichRouting[$param[0]]['name_url'];
        $fichRoutingModule = spyc_load_file(ROOT.DS.$fichRouting[$param[0]]['resource'].DS.'config/routing.yml');
        foreach ($fichRoutingModule as $key => $value) 
        {
            if($fichRoutingModule[$key]['controller'] == $param[1].':'.$param[2])
            {
                header('Location: '.BASE_URL.DS.$nameModule.DS.$fichRoutingModule[$key]['name_url'].'/');
                exit;
            }
        }
    }
}
