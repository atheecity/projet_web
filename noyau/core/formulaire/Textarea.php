<?php

include('global.php');

class Textarea
{
    
    private $textarea = '';
    
    private $attributsTextarea = array(
                                       'autofocus' => '',
                                       'cols' => '',
                                       'disabled' => '',
                                       'form' => '',
                                       'maxlength' => '',
                                       'name' => '',
                                       'placeholder' => '',
                                       'readonly' => '',
                                       'required' => '',
                                       'rows' => '',
                                       'wrap' => ''
                                       );
    
    function __construct()
    {
        $this->textarea .= '<textarea ';
    }
    
    function addPropriete($prop)
    {
        $globalHtml = new GlobalHtml();
        $tab = array_merge($globalHtml->getAttributsGlobal(), $globalHtml->getFormEvents(), $this->attributsTextarea);
        try 
        {
            //Test si les attributs sont valides
            if(count(array_diff_key($prop, $tab)) > 0)
                throw new Erreur("La propriété n'existe pas", 1);
            
            //Parcour des différents propriété
            foreach($prop as $cle=>$valeur)
            {
                $this->textarea .= $cle.'="'.$valeur.'" ';
            }
            $this->textarea .= 'required="requiered" ';
        } 
        catch(Erreur $e) 
        {
            return false;
        }
        $this->__destruct();
        return true;
    }
    
    function __toString()
    {
        return $this->textarea;
    }
    
    function __destruct()
    {
        $this->textarea .= '></textarea>';
    }
}
