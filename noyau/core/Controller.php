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
        $request = new Request();
        Routage::parse($request->getUrl(), $request);
        Routage::parse($request->getRecModule(), $request);
        $view = ROOT.DS.$request->getNameModule().DS.'views'.DS.$view;
        require($view);
    }
    
}
