<?php

/*
 *Ajout textarea
 */

class formulaire{
    
    private $champ = array('label' => '', 'type' => '', 'name' => '');
    private $formualire = "";
    
    function __construct($method, $action="")
    {
        $this->formualire .= '<form method="'.$method.'">';
    }
    
    function addLabel($label)
    {
        $this->formualire .= '<label>'.$label.'</label>';
    }

    function add($tab)
    {

        try 
        {
            if(count(array_diff_key($tab, $this->champ)) > 0)
                throw new Erreur("Le parametre n'existe pas", 1);
            
            if(isset($tab['label']))
                $this->addLabel($tab['label']);
            $this->formualire .= '<input type="'.$tab['type'].'" name="'.$tab['name'].'" required="required" /><br/>';
        } 
        catch(Erreur $e) 
        {
            echo $e;
        }
    }
    
    function addSelect($info, $option)
    {
        if(isset($info['label']))
            $this->addLabel($info['label']);
        $this->formualire .= '<select name="'.$info['name'].'" >';
        foreach ($option as $val)
        {
            $this->formualire .= '<option>'.$val;
        }
        $this->formualire .= '</select><br/>';
    }
    
    function addTextarea($option)
    {
        $textarea = new Textarea();
        try
        {
            if($textarea->addPropriete($option) == false)
                throw new Erreur('Le paramètre n\'existe pas', 1);
        }
        catch(Erreur $e)
        {
            echo $e;
        }
        $this->formualire .= $textarea;
    }
    
    function addBouton($info)
    {
        $this->formualire .= '<input type="'.$info['type'].'" value="'.$info['value'].'" name="'.$info['name'].'" />';
    }

    function toString()
    {
        return $this->formualire;
    }
    
    function _destruct()
    {
        $this->formualire .= '</form>';
    }
    
}