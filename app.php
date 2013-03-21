<?

//Fichier qui permet de charger tout les fichiers
require_once "config/autoload.php";

//Chargement fichier yml routing.yml
$Data = spyc_load_file('config/routing.yml');
 
//preg_match récupère le premier paramètre après app.php
if(preg_match('#app.php/([a-z]+)/#', $_SERVER['PHP_SELF'], $match))
{
	foreach ($Data as $val) {
		if($match[1] == $val['name_url'])
		{
			$Data2 = spyc_load_file($val['resource']."/config/routing.yml");
			preg_match('#'.$match[1].'/([a-z]+)#', $_SERVER['PHP_SELF'], $matchh);
			foreach ($Data2 as $val2) 
			{
				if(isset($matchh[1]))
				{
					if($matchh[1] == $val2['name_url'])
					{
						if(isset($val2['resource']))
						{
							
						}
						elseif(isset($val2['controller']))
						{
							$controller = explode(':', $val2['controller']);
							include $val['resource']."/controller/".$controller[0];
							$func = $controller[1];
							$func();
						}
						else
						{
							echo "ERREUR 1";
						}
					}
				}
				else
				{
					echo "ERREUR : Pas de fichier de routage dans le module : ".$val['name_url'];
				}
			}
		}
		else
		{
			echo "ERREUR";
		}
	}
}

?>