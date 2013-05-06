<?php 

class userModel extends Bd
{

	function verifMail($mail)
	{
		$test = $this->queryPX('Select identifiant from user where email=?', array(
			$mail));
		if(isset($test[0]['identifiant']))
			return false;
		else
			return true;
	}

	function verifPseudo($pseudo)
	{
		$test = $this->queryPX('Select identifiant from user where pseudo=?', array(
			$pseudo));
		if(isset($test[0]['identifiant']))
			return false;
		else
			return true;
	}

}