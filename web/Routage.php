<?php

function defineRoute($url)
{
    //Chargement du fichier qui contient toutes les routes 
    $Data = spyc_load_file('../config/routing.yml');
    
    //Récupère la première partie dans l'url
    if(preg_match('#app.php/([a-zA-Z1-9]*)/#', $_SERVER['PHP_SELF'], $match))
    {
        //Boucle sur chaque valeur du fichier de routage
        foreach ($Data as $val)
        {
            //Si la valeur dans le fichier de routage correspond a celle de l'url
            if($match[1] == $val['name_url'])
            {
                if(isset($val['resource']))
                {
                    //Chargement du fichier de routage du module
                    $Data2 = spyc_load_file('../'.$val['resource']."/config/routing.yml");
                    
                    if(preg_match('#'.$match[1].'/([a-z]+)/#', $_SERVER['PHP_SELF'], $matchh))
                    {
                        foreach ($Data2 as $val2)
                        {
                            if($matchh[1] == $val2['name_url'])
                            {
                                if(isset($val2['controller']))
                                {
                                    $controller = explode(':', $val2['controller']);
                                    require_once '../'.$val['resource']."/controller/".$controller[0];
                                    $func = $controller[1];
                                    $func();
                                    exit;
                                }
                            }
                        }
                        header("HTTP/1.0 404 Not Found");
                        exit;
                    }
                    else
                    {
                        header("HTTP/1.0 404 Not Found");
                        exit;
                    }
                }
                if(isset($val['controller']))
                {
                    
                }
            }
        }
        header("HTTP/1.0 404 Not Found");
        exit;
    }
    else
    {
        header("HTTP/1.0 404 Not Found");
    }
}
