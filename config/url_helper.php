<?

function asset($chemin)
{
    $ini = new Ini('../config/parameters.ini');
    $array = $ini->return_array('URL');
    echo $array['BASE'].$chemin;
}