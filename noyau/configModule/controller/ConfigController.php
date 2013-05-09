<?php

class ConfigController extends Controller
{
    
    function indexconfig()
    {
        $this->renderView('noyau/configModule/views/vues1.php');
    }

    function bdConfig()
    {
        //Création du formulaire 
        $form = new formulaire('POST');
        $form->add(array('typ' => 'text', 'name' => 'database_name', 'placeholder' => 'Host'));
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

                $this->header('configModule:ConfigController:siteConfig');
            }
            catch(Exception $e)
            {
                $erreur = "Erreur les parametres de connexion ne sont pas valides";
                //Chargement de la vue
                $this->renderView('noyau/configModule/views/vues_bd.php', array(
                    'form' => $form->toString(), 
                    'erreur' => $erreur));
            }
        }
        else
        {
            //Chargement de la vue
            $this->renderView('noyau/configModule/views/vues_bd.php', array(
                'form' => $form->toString()));
        }
    }

    function siteConfig()
    {
        //Formulaire 
        $form = new formulaire('POST');
        $form->add(array('type' => 'text', 'name' => 'name_site', 'placeholder' => 'Nom site web'));
        $form->add(array('type' => 'email', 'name' => 'mail_site', 'placeholder' => 'Mail site web'));
        $form->addButton(array('value' => 'Soumettre'), "Soumettre");
        $form->__destruct();

        if(isset($_POST['name_site']))
        {
            $array['name_site'] = $_POST['name_site'];
            $array['mail_site'] = $_POST['mail_site'];
            $ini = new Ini('../config/parameters.ini');
            $ini->add_array($array, 'SITE');

            $this->header('configModule:ConfigController:finConfig');
        }
        else
        {
            $this->renderView('noyau/configModule/views/vues_site.html.twig', array(
                'form' =>$form->toString()));
        }
    }

    function finConfig()
    {
        $this->renderView('noyau/configModule/views/vues_fin.html.twig');
    }   
}