<?php

define('WEB', dirname(__FILE__)); //Chemin dossier WEB
define('ROOT', dirname(WEB)); //Chemin dossier racine du projet
define('DS', DIRECTORY_SEPARATOR); //Séparateur (windows ou linux)
define('BASE_URL', dirname(dirname($_SERVER['SCRIPT_NAME'])));
define('CORE', ROOT.DS.'noyau'.DS.'core'); //Chemin pour accéder au dossier core

require CORE.DS.'includes.php';

new Routage();

//require 'spy.php';
//require_once 'Loader.php';
//require_once '../config/autoload.php';
//require_once 'Ini.php';
//require_once '../config/url_helper.php';

//defineRoute($_SERVER['PHP_SELF']);


