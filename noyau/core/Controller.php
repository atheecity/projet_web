<?php

class Controller
{
    
    private $variables = array();
    
    function renderView($view, $variables = null)
    {
        if(is_array($variables))
        {
            $this->variables += $variables;
        }
        extract($this->variables);
        $route = new Routage();
        $view = ROOT.DS.$route->getNameModule().DS.'views'.DS.$view;
        require($view);
    }
    
}
