<?php 

class DefaultController extends Controller
{
	
	function home()
	{
		$ini = new Ini('../config/parameters.ini');
        $var = $ini->return_array();
        if(array_key_exists('DATABASE', $var) && array_key_exists('SITE', $var))
			$this->renderView('module/defaultModule/views/home.html.twig');
		else
			header('Location: '.BASE_URL.DS.'configuration_webPlane1.0'.DS.'home'.DS);
	}

}