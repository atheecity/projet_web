<?php

require '../module/userModule/model/userModel.php';

class UserController extends Controller
{

	function connexion()
	{
		$form = new formulaire('POST'); 
		$form->add(array('type' => 'text', 'name' => 'identifiant', 'placeholder' => 'Identifiant'));
		$form->add(array('type' => 'password', 'name' => 'motdepasse', 'placeholder' => 'Mot de passe'));
		$form->addButton(array('value' => 'Soumettre'), "Soumettre");	
		$form->__destruct();

		if(isset($_POST['identifiant']))
		{
			//Execution 
		}
		else
		{
			$this->renderView('module/userModule/views/index.html.twig', array(
				'form' => $form->toString()));
		}
	}

	function inscription()
	{

		$userModel = new userModel();

		$form = new formulaire('POST'); 
		$form->add(array('type' => 'text', 'name' => 'pseudo', 'placeholder' => 'Pseudo'));
		$form->add(array('type' => 'password', 'name' => 'motdepasse', 'placeholder' => 'Mot de passe'));
		$form->add(array('type' => 'text', 'name' => 'nom', 'placeholder' => 'Nom'));
		$form->add(array('type' => 'email', 'name' => 'email', 'placeholder' => 'Adresse mail'));
		$form->addButton(array('value' => 'Soumettre'), "Soumettre");	
		$form->__destruct();

		if(isset($_POST['pseudo']) && isset($_POST['motdepasse']) && isset($_POST['nom']) &&
			isset($_POST['email']))
		{
			if($userModel->verifPseudo($_POST['pseudo']) && $userModel->verifMail($_POST['email']))
			{
				
			}
			else
			{
				$erreur = "Pseudo ou sdfsdfsd";
			}

			$this->renderView('module/userModule/views/inscription.html.twig', array(
				'form' => $form->toString(), 
				'erreur' => $erreur));

		}
		else
		{
			$this->renderView('module/userModule/views/inscription.html.twig', array(
				'form' => $form->toString()));
		}
	}

	function rechercheMdp()
	{
		$form = new formulaire('POST'); 
		$form->add(array('type' => 'email', 'name' => 'email', 'placeholder' => 'Adresse mail'));
		$form->addButton(array('value' => 'Soumettre'), "Soumettre");	
		$form->__destruct();

		if(isset($_POST['email']))
		{
			//Execution 
		}
		else
		{
			$this->renderView('module/userModule/views/rechercheMdp.html.twig', array(
				'form' => $form->toString()));
		}
	}
}