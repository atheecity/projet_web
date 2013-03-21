<?php

require_once "Loader.php";
$Loader = new Loader();

//Fichier php
## $Loader->addClass(array('nomFichier'));
$Loader->addClass(array(
	'module/fileSysteme/spy.php',
        'module/fileSysteme/erreur.php'
	)
);

//Ajout de Module
echo $Loader->addModule(array(
                         'noyau/configModule',
                         'noyau/formulaireModule',
                         ));

?>