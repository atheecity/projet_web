<?php 

class DefaultController extends Controller
{
	
	function home()
	{
		$this->renderView('module/defaultModule/views/vues2.html.twig');
	}

}