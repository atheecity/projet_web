<?php

class Textarea
{
    
    private $textarea = '';
    //Propriete valide pour un textarea
    private $propriete = array(
                               'class' => '',
                               'cols' => '',
                               'disabled' => '',
                               'id' => '',
                               'name' => '',
                               'readonly' => '',
                               'rows' => '',
                               'style' => '',
                               'onfocus' => '',
                               'onblur' => '',
                               'onselect' => '',
                               'onchange' => '');
    
    function __construct()
    {
        $this->textarea .= '<textarea ';
    }
    
    function addPropriete($prop)
    {
        try 
        {
            //Test si la propriété est valide pour un textarea
            if(count(array_diff_key($prop, $this->propriete)) > 0)
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
