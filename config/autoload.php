<?php

$Loader = new Loader();

//Ajout de Module
echo $Loader->addModule(array(
                         'noyau/configModule',
                         'noyau/formulaireModule',
                         'noyau/erreurModule',
                         ));

?>