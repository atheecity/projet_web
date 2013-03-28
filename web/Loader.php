<?php

class Loader
{
	//Ajout d'un module
	public function addModule($include)
	{
		//Parcours la liste des modules
		foreach ($include as $module)
		{
			$dir = "../".$module."/function";
			try
			{
				//Test si le module est bien un repertoire
				if(!is_dir($dir))
					echo "Erreur";
				
				//Array des fichiers dans le dossier function
				$files = scandir($dir);
				
				//Parcours la liste des fichiers
				foreach ($files as $file)
				{
					$fileName = $file;
					//Si le fichier possède l'éxtension .php alors charger le fichier
					if(strrchr($file, '.') == '.php')
					{
						require($dir.'/'.$fileName);
					}
				}
			}
			catch(Erreur $e)
			{
				echo $e;
			}
		}
	}
}

?>