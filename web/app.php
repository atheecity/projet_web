<?

//Fichier qui permet de charger tout les fichiers
require_once '../config/url_helper.php';
require_once 'Loader.php';
require_once '../config/autoload.php';
require_once 'spy.php';
require_once 'Ini.php';

//Chargement fichier yml routing.yml
$Data = spyc_load_file('../config/routing.yml');

//preg_match récupère le premier paramètre après app.php
if(preg_match('#app.php/([a-z]+)/#', $_SERVER['PHP_SELF'], $match))
{
	//Boucle sur chaque valeur du fichier de routage
	foreach ($Data as $val) {
		//Si la valeur dans le fichier de routage correspond a celle de l'url
		if($match[1] == $val['name_url'])
		{
			//Chargement du fichier de routage dans le module
			$Data2 = spyc_load_file('../'.$val['resource']."/config/routing.yml");
			
			preg_match('#'.$match[1].'/([a-z]+)#', $_SERVER['PHP_SELF'], $matchh);
			foreach ($Data2 as $val2) 
			{
				if(isset($matchh[1]))
				{
					if($matchh[1] == $val2['name_url'])
					{
						if(isset($val2['resource']))
						{
							//Lien vers un fichier
						}
						elseif(isset($val2['controller']))
						{
							$controller = explode(':', $val2['controller']);
							require_once '../'.$val['resource']."/controller/".$controller[0];
							$func = $controller[1];
							$func();
						}
						else
						{
							include('pages/404.html');
                            exit();
						}
					}
				}
				else
				{
					include('pages/404.html');
                    exit();
				}
			}
		}
		else
		{
			include('pages/404.html');
            exit();
		}
	}
}
else
{
    include('pages/404.html');
    exit();
}