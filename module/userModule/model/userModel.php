<?php 

class userModel extends Bd
{

	function verifMail($mail)
	{
		$test = $this->queryPX('Select identifiant from user where email=?', array(
			$mail));
		if(isset($test[0]['identifiant']))
			return true;
		else
			return false;
	}

	function verifPseudo($pseudo)
	{
		$test = $this->queryPX('Select identifiant from user where pseudo=?', array(
			$pseudo));
		if(isset($test[0]['identifiant']))
			return true;
		else
			return false;
	}



	function Connect($pseudo,$motdepasse)
	{		$test = $this->queryPX('Select identifiant from user where pseudo=? and motdepasse=?', array(
			$pseudo,$motdepasse));
		if(isset($test[0]['identifiant']))
			return true;
		else
			return false;
	}
// -------------------------- vérification de l'existence du pseudo sur la page de connexion -------------------------- OK 

	function UsrID($pseudo)
	{	$test = $this->queryPX('Select identifiant from user where pseudo=?', array(
			$pseudo));
		if(isset($test[0]['identifiant']))
			return true;
		else
			return false;
	}
// -------------------------- Recherche du Mot de Passe -------------------------- OK 

	function RechPwd($email)
	{

      $test = $this->queryPX('Select identifiant from user where email=?', array(
			$email));
      if (isset($test['identifiant']))
	{
       $mail=$test['email'];
       $pwd=$test['motdepasse'];
       $headers ='From: "nom"<adresse@fai.fr>'."\n"; 
	 $headers .='Reply-To: adresse_de_reponse@fai.fr'."\n"; 
	 $headers .='Content-Type: text/plain; charset="iso-8859-1"'."\n"; 
	 $headers .='Content-Transfer-Encoding: 8bit';
	 $objet = 'Récupération de votre mot de passe';
 
    		if(!mail($test['email'], $objet, $test['motdepasse'], $headers))
		echo 'probleme lors de l\'envoi du mail';
			else
				echo 'mail envoye';
     }
       
     }


// -------------------------- INSERTION DES DONNEES -------------------------- OK 

	function Insert($pseudo,$motdepasse,$nom,$email)
	{
	$resultat=$this->inserInto('user',array(NULL,$pseudo,$motdepasse,$nom,$email));
	if($resultat) {
	echo "Inscription terminée";
	return true ;}
	}


// -------------------------- vérification de l'existence du mot de passe sur la page de modification de profil -------------------------- OK 
     function UsrPwd($pwd)
	{	$test = $this->queryPX('Select identifiant from user where motdepasse=?', array(
			$pwd));
		if(isset($test[0]['identifiant']))
			return true;
		else
			return false;
	}

 // -------------------------- mISE à jour des info -------------------------- OK 
function Update($mail,$pwd,$ident)
	{
	$resultat=$this->mod("UPDATE user SET email = ? ,motdepasse =? WHERE pseudo =?",array($mail,$pwd,$ident));
	if($resultat) {
	echo "Modification terminée";
	return true ;}
	}





}