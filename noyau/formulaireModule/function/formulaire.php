<?php

class formulaire{
    
    private $formualire;
    
    function __construct($method, $action="")
    {
        $this->formualire .= '<form method="'.$method.'">';
    }

    function add($tab)
    {
        //Si attribut label existe l'ajouter puis le supprimer du tableau
        if(array_key_exists('label', $tab))
        {
            $attributsLabel;
            if(array_key_exists('id', $tab))
            {
                $attributsLabel['for'] = $tab['id'];
            }
            else
            {
                $attributsLabel['for'] = 'form_input_'.$tab['name'];
                $tab['id'] = 'form_input_'.$tab['name'];
            }
            $label = new Label();
            $label->addLabel($attributsLabel, $tab['label']);
            $this->formualire .= $label;
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
    
    function addBr()
    {
        $this->formualire .= '<br>';
    }
    
    /**
    * @name addSelect($attributs, $options)
    * @param array $attributs Ajoute des attributs au select
    * @param array $options Ajoute des options dans le select 
    * @return void 
    */  
    function addSelect($attributs, $options)
    {
        $select = new Select();
        try
        {
            if($select->addSelect($attributs, $options) == false)
                throw new Erreur('Le paramètre n\'existe pas', 1);
        }
        catch(Erreur $e)
        {
            echo $e;
        }
        $this->formualire .= $select;
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
            if($button->addButton($attributs, $text) == false)
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
    
    function __destruct()
    {
        $this->formualire .= '</form>';
    }
    
}