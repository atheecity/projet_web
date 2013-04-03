<?php

function indexconfig()
{
    require_once('../noyau/configModule/views/vues1.php');
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
            $yaml = Spyc::YAMLDump($array);
            $fp = fopen('../config/parameters_database.yml', 'w');
            fwrite($fp, $yaml);
            fclose($fp);
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