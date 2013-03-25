<?php

class Select
{
    
    private $select;
    
    private $attributsSelect = array(
                                     'autofocus' => '',
                                     'disabled' => '',
                                     'form' => '',
                                     'multiple' => '',
                                     'name' => '',
                                     'required' => '',
                                     'size' => '',
                                     'option' => '' //Attribut pour les options
                                     );
    
    public function __construct()
    {
        $this->select .= '<select ';
    }
    
    public function addSelect($attributs)
    {
        //Récupération attributs
        $globalHtml = new GlobalHtml();
        //Concaténation des trois array
        $tab = array_merge($globalHtml->getAttributsGlobal(), $globalHtml->getFormEvents(), $this->attributsSelect);
        $option = '';
        
        try 
        {
            //Test si les attributs sont valides
            if(count(array_diff_key($attributs, $tab)) > 0)
                throw new Erreur("La propriété n'existe pas", 1);
            
            //Test si l'attribut option existe
            if(array_key_exists('option', $attributs))
            {
                $option = $attributs['option'];
                unset($attributs['option']);
            }
            
            //Parcour des différents propriété
            foreach($attributs as $cle=>$valeur)
            {
                $this->select .= $cle.'="'.$valeur.'" ';
            }
            $this->select .= 'required="requiered"> ';
        } 
        catch(Erreur $e) 
        {
            return false;
        }
        
        foreach($option as $cle=>$valeur)
        {
            $this->select .= '<option value="'.$cle.'">'.$valeur.'</option>';
        }
        
        $this->__destruct();
        return true;
    }
    
    public function __toString()
    {
        return $this->select;
    }
    
    public function __destruct()
    {
        $this->select .= '</select>';
    }
    
}