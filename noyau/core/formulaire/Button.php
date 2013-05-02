<?php

class Button
{
    
    private $button = '';
    
    private $attributsButton = array(
                                     'autofocus' => '',
                                     'disabled' => '',
                                     'form' => '',
                                     'formaction' => '',
                                     'formenctype' => '',
                                     'formmethod' => '',
                                     'formnovalidate' => '',
                                     'formtarget' => '',
                                     'name' => '',
                                     'type' => '',
                                     'value' => ''
                                     );
    
    public function __construct()
    {
        $this->button .= '<button ';
    }
    
    /**
    * @name addButton($attributs, $options)
    * @param array $attributs Ajoute des attributs au button
    * @param string $text Libelle du bouton 
    * @return bool = TRUE/FALSE
    */  
    public function addButton($attributs=null, $text=null)
    {
        //Récupération attributs
        $globalHtml = new GlobalHtml();
        //Concaténation des trois array
        $tab = array_merge($globalHtml->getAttributsGlobal(), $globalHtml->getFormEvents(), $this->attributsButton);
        
        try 
        {
            //Test si les attributs sont valides
            if(count(array_diff_key($attributs, $tab)) > 0)
                throw new Erreur("La propriété n'existe pas", 1);
            
            //Parcour des différents attributs
            foreach($attributs as $cle=>$valeur)
            {
                $this->button .= $cle.'="'.$valeur.'" ';
            }
            $this->button .= '>'.$text;
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
        return $this->button;
    }
    
    public function __destruct()
    {
        $this->button .= '</button>';
    }
}
