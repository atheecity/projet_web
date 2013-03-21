<?php

//Chargement fichier yml 
$Data = spyc_load_file('contact/config/routing.yml');

if(!empty($_GET['page']))
{
	include $Data[$_GET['page']]['address'];
}

?>