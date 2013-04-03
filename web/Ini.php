<?php

class Ini
{
    
    private $filename;
    private $ini;
    
    /**
    * @name Ini($filename) Constructeur
    * @param string $filename Fichier .ini
    */  
    public function __construct($filename)
    {
        $this->filename = $filename;
    }
    
    /**
    * @name add_array($array) Permet d'écrire un tableau dans un fichier .ini
    * @param array  $array Tableau 
    */  
    public function add_array($array, $name_section = null)
    {
        $ini_array = parse_ini_file($this->filename, true);
        
        if($name_section != null)
            $this->ini .= "\n".$name_section."\n";
        
        foreach($array as $key => $val)
        {
            $this->ini .= $key." = ".$val."\n";
        }
        $fp = fopen($this->filename, 'a');
        fwrite($fp, $this->ini);
        fclose($fp);
    }
    
    /**
     * @name select_value($name_section = null) Retourne un array de la section passé en paramètre
     * @param string $name_section Nom de la valeur à retourner
     */
    public function return_file($name_section = null)
    {
        $ini_array = parse_ini_file($this->filename, true);
        
        //Test si le nom d'une section est passé en paramètre
        if($name_section != null)
        {
            $ini_array = $ini_array[$name_section];
        }
        
        return $ini_array;
    }
}
