<?php

class docController extends Controller
{

	public function index()
	{
		$this->renderView('module/docModule/views/default.html.twig');
	}

	public function chat()
	{
		$this->renderView('module/docModule/views/chat.html.twig');
	}

	public function bd()
	{
		$this->renderView('module/docModule/views/bd.html.twig');
	}

}