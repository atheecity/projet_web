<?php

class ConfigController extends Controller
{
    
    function indexconfig($test)
    {
        echo $test;
        require_once('../noyau/configModule/views/vues1.php');
    }
    
    function urlBaseConfig()
    {
        //Création formulaire
        $form = new formulaire('POST');
        $form->add(array('type' => 'text', 'name' => 'url_base', 'placeholder' => 'Url base'));
        $form->addButton(array('value' => 'Suivant'), "Suivant");
        $form->__destruct();
        
        $doss = explode('/', $_SERVER['SCRIPT_NAME']);
        $test = true;
        $chemin = "/";
        foreach($doss as $val)
        {
            if($test == true && $val != 'web')
            {
                if($val != '')
                    $chemin .= $val."/";
            }
            else
                $test = false;
        }
        
        //Si le formulaire est validé
        if(isset($_POST['url_base']))
        {
            $array['BASE'] = $_POST['url_base'];
            if(file_exists($_SERVER["DOCUMENT_ROOT"].$array['BASE'].'web/app.php'))
            {
                $ini = new Ini('../config/parameters.ini');
                $ini->add_array($array, 'URL');
                header('Location: ../../configuration/bd/');
            }
            else
            {
                $erreur = 'Erreur, le dossier web n\'est pas accessible.';
                include('../noyau/configModule/views/vues_url.php');
            }
        }
        else
            include('../noyau/configModule/views/vues_url.php');
    }

    function bdConfig()
    {
        //Création du formulaire 
        $form = new formulaire('POST');
        $form->add(array('type' => 'text', 'name' => 'database_name', 'placeholder' => 'Host'));
        $form->add(array('type' => 'text', 'name' => 'database_user', 'placeholder' => 'Utilisateur'));
        $form->add(array('type' => 'password', 'name' => 'database_password', 'placeholder' => 'Mot de passe'));
        $form->add(array('type' => 'text', 'name' => 'database_db', 'placeholder' => 'Base de donnees'));
        $form->addButton(array('value' => 'Soumettre'), "Soumettre");
        $form->__destruct();
        
        //Si le formulaire est valider
        if(isset($_POST['database_name']))
        {
            try
            {
                $bd = new PDO('mysql:host='.$_POST['database_name'].';dbname='.$_POST['database_db'], $_POST['database_user'], $_POST['database_password']);
                $array['database_name']  = $_POST['database_name'];
                $array['database_db']  = $_POST['database_db'];
                $array['database_user']  = $_POST['database_user'];
                $array['database_password']  = $_POST['database_password'];
                $ini = new Ini('../config/parameters.ini');
                $ini->add_array($array, 'DATABASE');
            }
            catch(Exception $e)
            {
                $erreur = "Erreur les parametres de connexion ne sont pas valides";
                //Chargement de la vue
                include('../noyau/configModule/views/vues_bd.php');
            }
        }
        else
        {
            //Chargement de la vue
            include('../noyau/configModule/views/vues_bd.php');
        }
        
    }
    
}