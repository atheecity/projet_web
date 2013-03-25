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
        //Si attribut label existe l'ajouter puis le supprimer du tableau
        if(array_key_exists('label', $tab))
        {
            $this->addLabel($tab['label']);
            unset($tab['label']);
        }
        
        $input = new Input();
        
        try
        {
            if($input->addInput($tab) == false)
                throw new Erreur('Un des attributs n\'existe pas', 1);
        }
        catch(Erreur $e)
        {
            echo $e;
        }
        $this->formualire .= $input;
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
    
    function addButton($attributs, $text)
    {
        $button = new Button();
        try
        {
            if($button->addButton($option, $text) == false)
                throw new Erreur('Un des attributs n\'existe pas', 1);
        }
        catch(Erreur $e)
        {
            echo $e;
        }
        $this->formualire .= $button;
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