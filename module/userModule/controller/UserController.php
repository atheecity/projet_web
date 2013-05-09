<?php

require '../module/userModule/model/userModel.php';

class UserController extends Controller
{

	function connexion()
	{
		$form = new formulaire('POST'); 
		$form->add(array('type' => 'text', 'name' => 'pseudo', 'placeholder' => 'Pseudo'));
		$form->add(array('type' => 'password', 'name' => 'motdepasse', 'placeholder' => 'Mot de passe'));
		$form->addButton(array('value' => 'Soumettre'), "Soumettre");	
		$form->__destruct();

		if(isset($_POST['pseudo']) && isset($_POST['motdepasse']))
		{    
			$userModel = new userModel();
            if(!$userModel->Connect($_POST['pseudo'],$_POST['motdepasse']))
			{
				echo "test";
				if ($userModel->UsrID($_POST['pseudo']))
				{
					$this->header('userModule:UserController:rechercheMdp');
				}
				else  
				{
                    $this->header('userModule:UserController:inscription');
				}
			}
			else
			{
				//$erreur = "Erreur";
				session_start(); 
                $_SESSION['pseudo'] = $_POST['pseudo']; 
			}
                 
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
			if(!$userModel->verifPseudo($_POST['pseudo']) && !$userModel->verifMail($_POST['email']))
			{
				$userModel->Insert($_POST['pseudo'],$_POST['motdepasee'],$_POST['nom'],$_POST['email']);
			}
			else
			{
				$erreur = "Pseudo ou email existant";
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
		$userModel = new userModel();

		$form = new formulaire('POST'); 
		$form->add(array('type' => 'email', 'name' => 'email', 'placeholder' => 'Adresse mail'));
		$form->addButton(array('value' => 'Soumettre'), "Soumettre");	
		$form->__destruct();

		if(isset($_POST['email']))
		{
			$userModel->RechPwd($_POST['email']);
		}
		else
		{
			$this->renderView('module/userModule/views/rechercheMdp.html.twig', array(
				'form' => $form->toString()));
		}
	}

	function ModifProfil()
    {
    	session_start();
    	if(isset($_SESSION['pseudo']))
    	{
    		$userModel = new userModel();
			$form = new formulaire('POST'); 
	      	$form->add(array('type' => 'email', 'name' => 'email', 'placeholder' => 'Nouveau Adresse mail'));
	      	$form->add(array('type' => 'password', 'name' => 'motdepasseAnc', 'placeholder' => 'Ancien mot de passe'));
	      	$form->add(array('type' => 'password', 'name' => 'motdepasseNouv', 'placeholder' => 'Nouveau mot de passe'));
	      	$form->addButton(array('value' => 'Soumettre'), "Modifier");
	      	$form->__destruct();

	      	if(isset($_POST['email']) && isset($_POST['motdepasseAnc']) && isset($_POST['motdepasseNouv']))
	      	{
		 		if($userModel->UsrPwd($_POST['motdepasseAnc']))
	       		{
	        		$userModel->Update($_POST['email'],$_POST['motdepasseNouv'],$_SESSION['pseudo']);
	        	}
	        	else
	        	{
	        		$this->renderView('module/userModule/views/modifPro.html.twig', array(
					'form' => $form->toString()));
	        	}
			}
			else
			{
				$this->renderView('module/userModule/views/modifPro.html.twig', array(
					'form' => $form->toString()));
			}
    	}
    	else
    	{
    		$this->header('userModule:UserController:connexion');
    	}
	}
}