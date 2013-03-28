<?php

class Label
{
    
    private $label;
    
    private $attributsLabel = array(
                                    'for' => '',
                                    'form' => '',
                                    );
    
    function __construct()
    {
        $this->label = '<label ';
    }
    
    function addLabel($attributs, $text)
    {
        //Récupération attributs
        $globalHtml = new GlobalHtml();
        //Concaténation des trois array
        $tab = array_merge($globalHtml->getAttributsGlobal(), $globalHtml->getFormEvents(), $this->attributsInput);
        
        try
        {
            //Test si les attributs sont valides
            if(count(array_diff_key($attributs, $tab)) > 0)
                throw new Erreur("La propriété n'existe pas", 1);
            
            //Parcour des différents attributs
            foreach($attributs as $cle=>$valeur)
            {
                $this->label .= $cle.'="'.$valeur.'" ';
            }
        } 
        catch(Erreur $e) 
        {
            return false;
        }
        
        $this->label .= '>'.$text;
        $this->__destruct();
    }
    
    function __toString()
    {
        return $this->label;
    }
    
    function __destruct()
    {
        $this->label .= '</label>';
    }
    
}
