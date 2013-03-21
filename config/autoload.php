<?php

require_once "noyau/erreurModule/function/Erreur.php";
require_once "noyau/loaderModule/function/Loader.php";
$Loader = new Loader();

//Fichier php
## $Loader->addClass(array('nomFichier'));
$Loader->addClass(array(
	'module/fileSysteme/spy.php',
	)
);

//Ajout de Module
echo $Loader->addModule(array(
                         'noyau/configModule',
                         'noyau/formulaireModule',
                         'noyau/erreurModule',
                         ));

?>