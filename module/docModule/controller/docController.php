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

	public function contact()
	{
		$form = new formulaire('POST');
		$form->add(array('type' => 'text', 'name' => 'name', 'placeholder' => 'Nom'));
		$form->add(array('type' => 'email', 'name' => 'email', 'placeholder' => 'Adresse mail'));
		$form->addTextarea(array('name' => 'contenu', 'placeholder' => 'Contenu'));
		$form->addButton(array('value' => 'Envoyer'), "Envoyer");
		$form->__destruct();

		$this->renderView('module/docModule/views/contact.html.twig', array(
			'form' => $form->toString()));
	}

	public function connexion()
	{
		$this->renderView('module/docModule/views/save.html.twig');
	}

	public function user()
	{
		$this->renderView('module/docModule/views/user.html.twig');
	}

	public function twii()
	{
		$this->renderView('module/docModule/views/twii.html.twig');
	}

	public function formulaire()
	{
		$this->renderView('module/docModule/views/formulaire.html.twig');
	}

	public function page()
	{
		$this->renderView('module/docModule/views/page.html.twig');
	}

	public function carrousel()
	{
		$this->renderView('module/docModule/views/carrousel.html.twig');
	}

}