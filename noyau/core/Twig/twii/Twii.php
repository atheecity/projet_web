<?php

class Twii 
{
	
	/**
	* Permet de charger un fichier de style
	**/
	public function asset($chemin) 
	{
		echo BASE_URL.DS.'web'.DS.$chemin;
	}

	/**
	* Permet de charger un controller depuis une vue
	* @param String $name_controller name_Module:name_Controller:name_function
	* @return Charge un controller 
	**/
	public function request($name_controller, $parametre = null)
	{
		$param = explode(':', $name_controller);
        $fichRouting = spyc_load_file(ROOT.DS.'config'.DS.'routing.yml');
        $addressModule = $fichRouting[$param[0]]['resource'];
        require_once ROOT.DS.$addressModule.DS.'controller'.DS.$param[1].'.php';
        $ini = new $param[1]();

        if(isset($parametre))
        {
        	$var = $ini->$param[2]($parametre);
        }
        else
        {	
        	$ini->$param[2]();
        }
        return isset($var);
	}

	public function connect()
	{
		if(session_id() == '')
			session_start();
		if(isset($_SESSION['pseudo']))
			return true;
		else
			return false;
	}
}