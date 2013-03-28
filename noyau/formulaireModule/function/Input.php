<?php

class Input
{
    
    private $input = '';
    
    private $attributsInput = array(
                                    'accept' => '',
                                    'alt' => '',
                                    'autocomplete' => '',
                                    'autofocus' => '',
                                    'checked' => '',
                                    'form' => '',
                                    'formaction' => '',
                                    'formenctype' => '',
                                    'formmethod' => '',
                                    'formnovalidate' => '',
                                    'formtarget' => '',
                                    'height' => '',
                                    'list' => '',
                                    'max' => '',
                                    'maxlength' => '',
                                    'min' => '',
                                    'multiple' => '',
                                    'name' => '',
                                    'pattern' => '',
                                    'placeholder' => '',
                                    'readonly' => '',
                                    'required' => '',
                                    'size' => '',
                                    'src' => '',
                                    'step' => '',
                                    'type' => '',
                                    'value' => '',
                                    'width' => ''
                                    );
    
    public function __construct()
    {
        $this->input .= '<input '; 
    }
    
    public function addInput($attributs)
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
            
            //Test si required est a false
            if(array_key_exists('required', $attributs))
            {
                if($attributs['required'] != false)
                    $this->input .= 'required ';
                unset($attributs['required']);
            }
            else
            {
                $this->input .= 'required ';
            }
            
            //Parcour des différents propriété
            foreach($attributs as $cle=>$valeur)
            {
                $this->input .= $cle.'="'.$valeur.'" ';
            }
        } 
        catch(Erreur $e) 
        {
            return false;
        }
        
        $this->__destruct();
        return true;
    }
    
    public function __toString()
    {
        return $this->input;
    }
    
    public function __destruct()
    {
        $this->input .= ' >';
    }
    
}
