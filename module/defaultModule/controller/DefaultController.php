<?php 

class DefaultController extends Controller
{
	
	function home()
	{
		$this->renderView('module/defaultModule/views/home.html.twig');
	}

}