<?php

class Loader
{
	//Fonction qui ajoute les fichiers php
	public function addClass($include)
	{
		foreach ($include as $a) 
		{
			require($a);
		}
	}	

	public function addModule($include)
	{

	}
}

?>